<?php namespace App\Http\Controllers;

use DB;
use App\Quotation;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Facturas\Facturas;
use App\Facturas\Productos;
use App\User;
use Illuminate\Http\Request;
use SoapClient; 
use Auth;
use PDF;

class HomeController extends Controller
{
    /**s
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
      if(Auth::user()->id == '2'){
        //Se envian todas las facturas que pertenecen a ese cliente.
        $facturas = Facturas::select('*')->get();
        $productos = Productos::select('*')->get();
        $user = User::select('business_name', 'phone', 'address', 'state', 'city', 'colonia', 'postal', 'email', 'rfc')->where('id', Auth::user()->id)->get();

        return view('home')->with(['facturas' => $facturas, 'productos' => $productos]);


      }else{
        //Se envian todas las facturas que pertenecen a ese cliente.
        $facturas = Facturas::select('*')->where('email', Auth::user()->email)->get();
        // echo '<pre>';var_dump($facturas);exit(); echo '</pre>';
        $productos = Productos::select('*')->where('email', Auth::user()->email)->get();
        $user = User::select('business_name', 'phone', 'address', 'state', 'city', 'colonia', 'postal', 'email', 'rfc')->where('id', Auth::user()->id)->get();
        $rfc = DB::table('rfc_user')->select('id','rfc')->where('user_id', Auth::user()->id )->get();
        $pisapesos = Productos::select(DB::raw('SUM(importe) as importe') )->where('id_user', Auth::user()->id )->where('estatus', 'APROBADO')->get();
        $pisa_pesos = number_format($pisapesos[0]->importe, 2);
      
        //calcular pisapesos por factura
        /*$facturas = Facturas::select(DB::raw('ROUND(SUM(importe),2) AS pisapesos'), 'facturas.*')
          ->join('producto', 'facturas.id', 'producto.id_factura')
          ->where('producto.estatus', 'APROBADO')
          ->where('producto.email', Auth::user()->email)
          ->groupBy*/

      //$facturas1 = Facturas::select('facturas.*')->get(); 
      // echo '<pre>'; var_dump($facturas); echo '</pre>';  
        return view('home')->with(['facturas' => $facturas, 'productos' => $productos, 'user' => $user, 'rfc' => $rfc, 'pisapesos' => $pisa_pesos ]);
      }
    }

    public function validacion(Request $request){
            if ($request->ajax() && $request->isMethod('POST')) {
                  // Obtiene el archivo cargado
                  //$name_file = $request->file('factura-xml')->getClientOriginalName();
                  // Valida el formato del archivo
                  $labels = array('extension' => 'extensión');
                  //$messages = [ 'extension.required' => 'Extension incorrecta' ];
                  $file_validator = Validator::make(
                    [
                      'attachment' => $request->file('factura-xml'),
                      'extension'  => Str::lower($request->file('factura-xml')->getClientOriginalExtension()),
                    ],
                    [
                      'attachment' => 'required',
                      'extension'  => 'required|in:xml',
                    ],
                    [ 
                      'extension.in' => 'La extensión seleccionada es invalida' 
                    ],
                    $labels
                  );
                  // Verifica que no haya errores de validacion
                if($file_validator->fails()){
                     return response()->json(array(
                              'success'=>false,
                              'errors'=>$file_validator->getMessageBag()->toArray()
                          ));
                   // return redirect('panel/dashboard')->withErrors($file_validator)->withInput();
                }else{

                       // Obtiene el archivo xml cargado del directorio
                        $comprobante = simplexml_load_file($request->file('factura-xml'));
                        $ns = $comprobante->getNamespaces(true);
                        $comprobante->registerXPathNamespace('cfdi', $ns['cfdi']);
                        $comprobante->registerXPathNamespace('tfd', $ns['tfd']);
                        $client = new SoapClient('https://consultaqr.facturaelectronica.sat.gob.mx/consultacfdiservice.svc?wsdl');

                        // Obtiene la informacion del archivo generado
                        $rfc_emisor = utf8_encode(strval($comprobante->xpath('//cfdi:Comprobante//cfdi:Emisor')[0]['Rfc']));
                        $rfc_receptor = utf8_encode(strval($comprobante->xpath('//cfdi:Comprobante//cfdi:Receptor')[0]['Rfc']));
                        $total = floatval($comprobante['Total']);
                        $uuid = strtoupper(strval($comprobante->xpath('//tfd:TimbreFiscalDigital')[0]['UUID']));
                        $factura = "?re={$rfc_emisor}&rr={$rfc_receptor}&tt={$total}&id={$uuid}";
                        $prm = array('expresionImpresa' => $factura);                 
                        $buscar = $client->Consulta($prm);

                        //var_dump($buscar->ConsultaResult->Estado );exit();
                        //Se valida el estatus de la factura. Faltan agregar los diferentes estatus invalidos
                        if($buscar->ConsultaResult->Estado == 'Cancelado'){
                                return response()->json(array(
                                    'success'=>'invalida',
                                    'errors'=> 'Su Factura con Folio ' . strval( $comprobante['Folio'] ) .' esta cancelada o no es valida.'
                                ));
                        }

                        $emisor = $comprobante->xpath('//cfdi:Emisor');
                        $receptor = $comprobante->xpath('//cfdi:Receptor');
                        //Se genera el registro de la factura
                        $factura_data = DB::table('facturas')->insertGetId([
                            'id_user' => Auth::user()->id,
                            'id_rfc' => $request->id_rfc,
                            'email' => Auth::user()->email,
                            'folio' => strval( $comprobante['Folio'] ),
                            'emisor' => strval( $emisor[0]['Nombre'] ),
                            'rfc_emisor' => strval( $receptor[0]['Rfc'] ),
                            'receptor' => strval( $receptor[0]['Nombre'] ),
                            'rfc_receptor' => strval( $receptor[0]['Rfc'] ),
                            'subtotal' => strval( $comprobante['SubTotal'] ),
                            'total' => strval( $comprobante['Total'] ),
                            'descuento' => strval( $comprobante['Descuento'] ) != null ?  strval( $comprobante['Descuento'] )  : '0.00',
                            'moneda' => strval( $comprobante['Moneda'] ),
                            'metodo_pago' => strval( $comprobante['MetodoPago'] ),
                            'lugar_expedicion' => strval( $comprobante['LugarExpedicion'] ),
                            'fecha' => strval( $comprobante['Fecha'] )
                        ]);

                        $xml_info = array();
                        $detalle = array();

                            // Se generan los registros de productos que existen dentro de esa factura
                            $conceptos = $comprobante->xpath('//cfdi:Comprobante//cfdi:Conceptos//cfdi:Concepto');
                            foreach ( $conceptos as $key => $concepto ){

                              //Validate that product exist inside active products table of PISA if not, send it to validation, status change.
                              $datos = DB::table('producto')
                                  ->where('no_identificacion', '=', $concepto['NoIdentificacion'])
                                  ->orWhere('descripcion', '=', $concepto['Descripcion'])
                                  ->get();

                               if( isset( $datos[0] ) && ( $datos[0]->no_identificacion != null ) && ( $datos[0]->estatus == 'APROBADO' )  ){
                                  $status = 'APROBADO';
                                }else{
                                  $status = 'PENDIENTE';
                                }


                                   $producto_detalle = [
                                          'no_identificacion' => strval($concepto['NoIdentificacion']) != null ? strval($concepto['NoIdentificacion']) : '',
                                          'folio_factura' => strval( $comprobante['Folio'] ) != null ?strval( $comprobante['Folio'] ) : '',
                                          'id_factura' => $factura_data,
                                          'id_user' => Auth::user()->id,
                                          'id_rfc' => $request->id_rfc,
                                          'email' => Auth::user()->email,
                                          'unidad' => strval($concepto['Unidad']) != null ? strval($concepto['Unidad']) : '',
                                          'clave_unidad' => strval($concepto['ClaveUnidad']) != null ? strval($concepto['ClaveUnidad']) : '',
                                          'clave_prod_ser' => strval($concepto['ClaveProdServ']) != null ? strval($concepto['ClaveProdServ']) : '',
                                          'descripcion' => strval($concepto['Descripcion']) != null ? strval($concepto['Descripcion']) : '',
                                          'cantidad' => strval($concepto['Cantidad']) != null ? strval($concepto['Cantidad']) : '',
                                          'descuento' => floatval($concepto['Descuento']) != null ? floatval($concepto['Descuento']) : '0.00',
                                          'importe' => floatval($concepto['Importe']) != null ? floatval($concepto['Importe']) : '0.00',
                                          'valor_unitario' => floatval($concepto['ValorUnitario']) != null ? floatval($concepto['ValorUnitario']) : '0.00',
                                          'estatus' => $status
                                        ];

                                    $producto = DB::table('producto')->insertGetId($producto_detalle);
                                      //Se envia el arreglo de objetos con todos los productos 
                                    $detalle[] = $producto_detalle;

                                    $traslado = $comprobante->xpath('//cfdi:Comprobante//cfdi:Conceptos//cfdi:Concepto//cfdi:Impuestos//cfdi:Traslados//cfdi:Traslado')[$key];
                                    $producto_impuesto = [
                                          'id_factura' => $factura_data,
                                          'id_producto' => $producto,
                                          'base_traslado' => floatval(isset($traslado['Base'])) && floatval($traslado['Base']) != null ? floatval($traslado['Base']) : '0.00',
                                          'impuesto_traslado' => strval(isset($traslado['Impuesto'])) && strval($traslado['Impuesto']) != null ? strval($traslado['Impuesto']) : 'NULL',
                                          'tipo_factor_traslado' => strval(isset($traslado['TipoFactor'])) && strval($traslado['TipoFactor']) != null ? strval($traslado['TipoFactor']) : 'NULL',
                                          'tasa_cuota_traslado' => floatval(isset($traslado['TasaOCuota'])) && floatval($traslado['TasaOCuota']) != null ? floatval($traslado['TasaOCuota']) : '0.00',
                                          'importe_traslado' => floatval(isset($traslado['Importe'])) && floatval($traslado['Importe']) != null ? floatval($traslado['Importe']) : '0.00'
                                        ];

                                    $producto_imp = DB::table('producto_impuestos')->insertGetId($producto_impuesto);

                      //echo '<pre>'; var_dump( $producto_impuesto ); echo '</pre>';
                         }
                         //Info para mostrar en la vista
                        $factura_info = array();
                        $factura_info[] = array(
                            'folio' => strval( $comprobante['Folio'] ),
                            'fecha' => strval( $comprobante['Fecha'] ),
                            'total' => $total
                        );

                       return ['success' => true, 'factura' => $factura_info, 'xml_info' =>  $detalle];         
                }
            }    
    }

    //Client perfil
    public function filtro_rfc(Request $request){

       // $facturas = Facturas::select('*')->where('id_rfc', $request->id)->where('id_user', Auth::user()->id )->get();
        $productos = Productos::select('*')->where('id_rfc', $request->id)->where('id_user', Auth::user()->id )->get();
        $pisapesos = Productos::select(DB::raw('SUM(importe) as importe') )->where('id_rfc', $request->id)->where('id_user', Auth::user()->id )->where('estatus', 'APROBADO')->get();
        $pisa_pesos = number_format($pisapesos[0]->importe, 2);
        //calcular pisapesos por factura
        $facturas = Facturas::select(DB::raw('ROUND(SUM(importe),2) AS pisapesos'), 'facturas.*')
          ->join('producto', 'facturas.id', 'producto.id_factura')
          ->where('producto.estatus', 'APROBADO')
          ->where('facturas.id_rfc', $request->id)
          ->where('facturas.id_user', Auth::user()->id )
          ->where('producto.email', Auth::user()->email)
          ->groupBy('facturas.id')
          ->get(); 

        return response()->json([
            'facturas' => $facturas,
            'productos' => $productos,
            'pisapesos' => $pisa_pesos
        ]);  
    }

    public function factura_info( $id, $accion ){ 

       // $facturas = Facturas::select('*')->where('id', $id)->get()->toArray();
        $facturas = Facturas::select(DB::raw('ROUND(SUM(importe),2) AS pisapesos'), 'facturas.*')
          ->join('producto', 'facturas.id', 'producto.id_factura')
          ->where('producto.estatus', 'APROBADO')
          ->where('facturas.id', $id)
          ->groupBy('facturas.id')
          ->get(); 

        $productos = Productos::select('*')->where('id_factura', $id)->get()->toArray();

        return view('factura_info')->with([ 'facturas' => $facturas, 'productos' => $productos, 'accion' => $accion ]);  
    }

     //Admin perfil
    public function validacion_producto(Request $request){

        $id = $request->id;
        $estatus = $request->estatus;
        if($estatus == 'no_aprobados'){ $estatus = "NO APROBADO"; }

       //Se valida el producto y si es correcto se agrega a la tabla de productos validos.
        $product =  DB::table('producto')->where('id', '=', $id )->get();

          if( isset( $product[0] ) && ( $product[0] != null ) ){
              $status_change = DB::table('producto') 
                  //->where('no_identificacion', '=', $product[0]->no_identificacion )
                  ->where('id', '=', $id)
                  ->update(['estatus' => $estatus]);
          }

        $data = [ 
          'success' => 'true', 
          'message' => 'Producto ' . $product[0]->no_identificacion . ' ha sido actualizado con estatus ' . $request->estatus . '.', 
          'producto' => $product[0]->no_identificacion, 
          'estatus' => $request->estatus 
        ];

        return $data; 
    }

    public function imprimir_reporte(Request $request){
       // if($request->ajax() && $request->isMethod('POST'))
          // Se cambia el formato de fecha que viene desde el cliente.
          $fecha = explode(' - ', $request->daterange);
          $date_from = ''; $date_to = '';   
          $date_from = date("Y/m/d", strtotime($fecha[0]));
          $date_to = date("Y/m/d", strtotime($fecha[1]));

          $infoFormato = array();

          $facturas = Facturas::select('facturas.id', 'facturas.id_user', 'facturas.email', 'facturas.folio', 'facturas.subtotal', 'facturas.total', 'facturas.descuento', 'facturas.moneda', 'facturas.metodo_pago', 'facturas.lugar_expedicion', 'facturas.fecha')
                   ->whereBetween('fecha', [ $date_from, $date_to ])
                   ->groupBy('facturas.id')->get()->toArray();

          $infoFormato = Facturas::select('facturas.id', 'facturas.id_user', 'facturas.email', 'facturas.folio', 'facturas.subtotal', 'facturas.total', 'facturas.descuento', 'facturas.moneda', 'facturas.metodo_pago', 'facturas.lugar_expedicion', 'facturas.fecha',
                    'prod.id','prod.no_identificacion', 'prod.unidad', 'prod.clave_unidad', 'prod.clave_prod_ser', 'prod.descripcion', 'prod.cantidad', 'prod.descuento', 'prod.importe', 'prod.valor_unitario', 'prod.estatus','pro_imp.base_traslado', 'pro_imp.impuesto_traslado', 'pro_imp.tipo_factor_traslado', 'pro_imp.tasa_cuota_traslado', 'pro_imp.importe_traslado')
                   ->join('producto as prod', 'facturas.id', '=', 'prod.id_factura')
                   ->join('producto_impuestos as pro_imp', 'prod.id', '=', 'pro_imp.id_producto')
                   ->where('prod.estatus',  $request->estatus_reporte)
                   ->whereBetween('fecha', [ $date_from, $date_to ])->get()->toArray();
  
          /*$pdf = PDF::loadView('partials.pdf.reporte', $infoFormato);
          echo utf8_encode( $pdf->stream() );*/
          

          $pdf = PDF::loadView('partials.pdf.reporte', ['infoFormato' => $infoFormato, 'facturas' => $facturas]);
          return $pdf->stream();
    }

    public function agregar_rfc(Request $request){
    /* 
      Validaciones:
      Campo Requerido
      Si ya hay mas de dos frc con el mismo id enviar un error a la vista
      Validación de numero de caracteres en el rfc
      RFC unico
    */ 
            $rules = array(
              'rfc' => 'required|unique:rfc_user|min:12|max:13'
            );

            $messages = array(
              'rfc.required' => 'El campo rfc es obligatorio',
              'rfc.min'      => 'El minimo permitido son 12 caracteres',
              'rfc.max'      => 'El maximo permitido son 13 caracteres',
              'rfc.unique'   => 'El campo rfc debe ser unico'
            );

            $validator = Validator::make($request->all(), $rules, $messages);

          if ($validator->fails()) {
              return redirect('home')
                        ->withErrors($validator)
                        ->withInput();
          }

          if( DB::table('rfc_user')->where('user_id', '=', Auth::user()->id)->count() >= 3 )
          {
            return redirect('/home')->with('rfc_maximo', 'Limite de RFC registrados.');
          }else{

            $insert = DB::table('rfc_user')->insertGetId([
              'user_id' => Auth::user()->id, 
              'rfc' => $request->rfc
            ]);

          return redirect('/home')->with('message','Servicio dado de alta correctamente');


      }

    }


    public function send_mail(Request $request){
      //Enviar correo con los datos del producto a validar
      $product_info = Productos::select('*')->where('id', '=', $request->product_id )->get()->toArray();
      $producto = $product_info[0]['no_identificacion'];

      $mensaje = "Folio de Factura: " . $product_info[0]['folio_factura']. "\r\n";
      $mensaje .= "No Identificacion: " . $product_info[0]['no_identificacion'] . "\r\n";
      $mensaje .= "Unidad: " . $product_info[0]['unidad'] . " \r\n";
      $mensaje .= "Descripcion: " . $product_info[0]['descripcion'] . "\r\n";
      $mensaje .= "Cantidad: " . $product_info[0]['cantidad'] . " \r\n";
      $mensaje .= "Descuento: " . $product_info[0]['descuento'] . " \r\n";
      $mensaje .= "Importe: " . $product_info[0]['importe'] . " \r\n";
      $mensaje .= "Valor Unitario: " . $product_info[0]['valor_unitario'] . " \r\n";
      $mensaje .= "Comentario: " .  $request->mensaje . " \r\n";

      $to  = 'ncedeno@mindgroup.mx';//
      $subject = 'Mensaje de '.  Auth::user()->name;

      // To send HTML mail, the Content-type header must be set
      $header = 'Mime-Version: 1.0 \r\n';
      $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $header .= 'To: Contacto Pisa Agropecuaria <validaproducto@pisaagropecuaria.com>, Contacto <validaproducto@pisaagropecuaria.com>' . "\r\n";
      $header .= 'From:'. Auth::user()->name.'<'.Auth::user()->email.'>' . "\r\n";
      $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";

      $mail = mail($to, $subject, $mensaje, $header);
      echo $mail;

    }

  //Deshabilita el registro de Usuario, para que ya no lo muestre dentro del listado de productos no aprobados.
    public function eliminar(Request $request){
      $product =  DB::table('producto')->where('id', '=', $request->id_registro )->get();

          if( isset( $product[0] ) && ( $product[0] != null ) ){
              $status_change = DB::table('producto') 
                  ->where('id', '=', $request->id_registro)
                  ->update(['estatus_cliente' => 'DESHABILITADO']);
          }

          $data = [ 
            'success' => 'true', 
            'message' => 'Producto ' . $product[0]->no_identificacion . ' eliminado correctamente.' 
            ];

        return $data; 
      
    }

    //Edición de descripción de producto, dentro del listado de productos como Administrador.
    public function editar(Request $request){

      $product =  DB::table('producto')->where('id', '=', $request->id_registro )->get();

          if( isset( $product[0] ) && ( $product[0] != null ) ){
              $status_change = DB::table('producto') 
                  ->where('id', '=', $request->id_registro)
                  ->update(['descripcion' =>  $request->descripcion]);
          }

          $data = [ 
            'success' => 'true', 
            'message' => 'Producto ' . $product[0]->no_identificacion . ' editado correctamente.' 
            ];

        return $data; 
      
    }



     
}
