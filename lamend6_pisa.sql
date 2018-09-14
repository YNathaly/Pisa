-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 21-08-2018 a las 16:41:53
-- Versión del servidor: 10.2.12-MariaDB-log
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lamend6_pisa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` int(11) NOT NULL,
  `id_user` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `folio` varchar(50) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) DEFAULT NULL,
  `moneda` enum('MXN','USD') NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `lugar_expedicion` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id`, `id_user`, `email`, `folio`, `subtotal`, `total`, `descuento`, `moneda`, `metodo_pago`, `lugar_expedicion`, `fecha`) VALUES
(1, 15, 'christian@example.com', '395', '4379.84', '4237.37', '218.99', 'MXN', 'PPD', 44800, '2018-01-18 16:30:03'),
(3, 15, 'christian@example.com', '600', '1568.04', '1568.04', '0.00', 'MXN', 'PPD', 44800, '2018-01-26 16:43:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(17, '2014_10_12_000000_create_users_table', 1),
(18, '2014_10_12_100000_create_password_resets_table', 1),
(19, '2018_06_05_163031_create_roles_table', 1),
(20, '2018_06_05_165618_create_role_user_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('ncedeno@mindgroup.mx', '$2y$10$HdkRWjLdS98L4KL1QTogPeldZqTS3pCY7mYXrSA8dvOfTqrZseCmG', '2018-06-13 21:14:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `no_identificacion` varchar(100) NOT NULL,
  `folio_factura` varchar(100) NOT NULL,
  `id_factura` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `unidad` varchar(100) NOT NULL,
  `clave_unidad` varchar(100) NOT NULL,
  `clave_prod_ser` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `cantidad` varchar(50) NOT NULL,
  `descuento` float(10,2) DEFAULT NULL,
  `importe` float(10,2) NOT NULL,
  `valor_unitario` float(10,2) NOT NULL,
  `estatus` enum('PENDIENTE','APROBADO','NO APROBADO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `no_identificacion`, `folio_factura`, `id_factura`, `id_user`, `email`, `unidad`, `clave_unidad`, `clave_prod_ser`, `descripcion`, `cantidad`, `descuento`, `importe`, `valor_unitario`, `estatus`) VALUES
(1, 'PIR150MG', '395', 1, 15, 'christian@example.com', 'PZA', 'H87', 51102600, 'PIROFLOX 150MG 20TBS', '20.00', 142.10, 2842.00, 142.10, 'APROBADO'),
(2, 'PIR150MG', '395', 1, 15, 'christian@example.com', 'PZA', 'H87', 51102600, 'PIROFLOX 150MG 20TBS', '4.00', 0.00, 0.04, 0.01, 'APROBADO'),
(3, 'VET120ML', '395', 1, 15, 'christian@example.com', 'PZA', 'H87', 42121600, 'VETERIBAC SPRAY MASCOTAS 120ML *16% IVA', '5.00', 25.17, 503.45, 100.69, 'NO APROBADO'),
(4, 'KIR50', '395', 1, 15, 'christian@example.com', 'PZA', 'H87', 51181700, 'KIROPRED 50 20TBS', '5.00', 51.72, 1034.35, 206.87, 'PENDIENTE'),
(11, 'SC75MG', '600', 3, 15, 'christian@example.com', 'PZA', 'H87', 51102600, 'SPECTRUM CEFALEXINA 75MG 20TBS', '1.00', 0.00, 94.88, 94.88, 'PENDIENTE'),
(12, 'SC60020TBS', '600', 3, 15, 'christian@example.com', 'PZA', 'H87', 51102600, 'SPECTRUM CEFALEXINA 600MG 20TBS', '1.00', 0.00, 365.48, 365.48, 'PENDIENTE'),
(13, 'ENRD100ML', '600', 3, 15, 'christian@example.com', 'PZA', 'H87', 51102600, 'ENROL C/DIPIRONA 100ML', '1.00', 0.00, 133.12, 133.12, 'PENDIENTE'),
(14, 'VETM1MG', '600', 3, 15, 'christian@example.com', 'PZA', 'H87', 42121605, 'VETMEDIN 1.25MG 100CAPS', '1.00', 0.00, 849.75, 849.75, 'PENDIENTE'),
(15, 'STO60ML', '600', 3, 15, 'christian@example.com', 'PZA', 'H87', 42121600, 'STOP ON 60ML', '1.00', 0.00, 37.31, 37.31, 'PENDIENTE'),
(16, 'STO250ML', '600', 3, 15, 'christian@example.com', 'PZA', 'H87', 42121600, 'STOP ON 250ML', '1.00', 0.00, 87.50, 87.50, 'PENDIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_validos`
--

CREATE TABLE `productos_validos` (
  `product_id` int(12) NOT NULL,
  `no_identificacion` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos_validos`
--

INSERT INTO `productos_validos` (`product_id`, `no_identificacion`, `product_name`) VALUES
(4000079, '', 'SOL CS INY.FLEXOVAL 1000ML'),
(4000158, '', 'ELECTROLIT FRESA ORAL 625ML PLAS'),
(4000164, '', 'ELECTROLIT COCO ORAL 625ML PLA'),
(4000252, '', 'AGUA ESTERIL SOL P/IRRI 500ML FCO.PLASTI'),
(4000270, '', 'AGUA INY 5ML C/100 AMP. PLAS'),
(4000394, '', 'SOL  CS INY 100ML MINIOVAL'),
(4000927, '', 'ENDOZIME AW PLUS GALON 4000 ML'),
(4001200, '', 'ACTYNOCEF 4g. C/12 fcos.'),
(4001201, '', 'AMINOFOSCAL VIT. 500'),
(4001203, '', 'COMPLENAY B-12 ELIXIR 100 ml C/ 25 Frasc'),
(4001204, '', 'GENTALEX FUERTE 250 ML.'),
(4001205, '', 'MASTILIBER 10ml Cubeta C/30 Jeringas'),
(4001206, '', 'PENBACORT SUSPENSION 100 mlx12'),
(4001207, '', 'PENBACORT 4\'000\'000 U.I.'),
(4001209, '', 'SEBA ADE 100 ml.'),
(4001209, '', 'SEBA ADE 100 ml.'),
(4001210, '', 'SEBA ADE 500 ml.'),
(4001214, '', 'STOP ON 250ml C/12fcos.'),
(4001218, '', 'CAROSEN 50g. C/20 sob.'),
(4001222, '', 'FERRITON 200 100ml C/12 fcos.'),
(4001226, '', 'FURACINE pomada 85g.g'),
(4001227, '', 'FURACINE pomada 453g'),
(4001234, '', 'COMPLENAY B-12 ELIX. 3.5 LT'),
(4001235, '', 'GENTALEX FTE 100 100ml C/12FCO'),
(4001236, '', 'GENTAMAST 10ml Cubeta C/30 Jeringas'),
(4001238, '', 'COMPLENAY B-12 POLVO 2KG'),
(4001241, '', 'CAROSEN C POLVO SOL 200g C/25'),
(4001242, '', 'ACTYNOXEL RTU SUSP INY 100ml'),
(4001250, '', 'ECTOSIN MP SOL INY 1% 500ml'),
(4001251, '', 'ECTOSIN MP SOL INY 1% 1000ml'),
(4001254, '', 'ACTYNOXEL RTU SUSP INY 250ml'),
(4001256, '', 'PIROFLOX 10% SOL INY 250ml'),
(4001264, '', 'PIROFLOX SOL. ORAL 20% 1L'),
(4001265, '', 'PIROFLOX SOL. ORAL 20% 5L'),
(4001267, '', 'SEBENDAZOL 4% POLVO ORAL 25KG'),
(4001269, '', 'SOLUCION CS 7.5% S.I 1000mlVET'),
(4001271, '', 'SOLUCION HT PISA 2.5Lt Bsa.VET'),
(4001272, '', 'SOL.HT BOLSA 5 Lt SOL.INY. VET'),
(4001273, '', 'SOL. Cs PLASCO 500 ml'),
(4001274, '', 'SOL. Cs PLASCO 1000 ml'),
(4001275, '', 'SOL. Dx5% PLASCO 500 ml'),
(4001276, '', 'SOL. Dx5% PLASCO 1000 ml'),
(4001277, '', 'SOL HT FLEXO VAL 500 ML VET'),
(4001278, '', 'SOL. HT PLASCO 1000 mlL'),
(4001279, '', 'SOL DX-50 Plas 500ml VET'),
(4001285, '', 'AGUA ESTERIL 1000ml VET PISA'),
(4001286, '', 'ANESKET VET. 1000 mg/10 ml'),
(4001288, '', 'GENTAERBA Pvo. 10g. sobre c/20'),
(4001289, '', 'GENTAERBA 100 ml VET'),
(4001290, '', '3 SULFAS Solucion Iny. 100 ml'),
(4001291, '', '3 SULFAS Solucion Iny. 250 ml'),
(4001292, '', '3 SULFAS Solucion Iny. 500 ml'),
(4001293, '', 'PIROFLOX 5% Inyectable 250ml'),
(4001294, '', 'PIROFLOX 5% S.Iny. 50ml VET'),
(4001297, '', 'SEBACICLINA 50 SOL.INY. 500 ML'),
(4001299, '', 'OXITOPISA 20UI sol.iny.fco.amp.50ml(Vet)'),
(4001300, '', 'OXITOPISA 20UI sol.iny.fco.amp.100ml(Vet'),
(4001301, '', 'FENPIZOL GRAN 22% 10.23gC/50'),
(4001302, '', 'FENPIZOL pvo4%sob.12.5gc/50'),
(4001303, '', 'CALCIOSOL C/150 COMP. VET'),
(4001304, '', 'CALCIOSOL CON FIJ.Y DEXT.500ml'),
(4001305, '', 'ALNEX Sol. Iny. 250 ml VET'),
(4001306, '', 'ALNEX Sol. Iny. 100ml VET'),
(4001308, '', 'HENEXAL VET. 10 ml. Iny.'),
(4001310, '', 'FLEBOTEK VETERINARIO'),
(4001311, '', 'FLEBOTEK CON ESPIRAL veterinario'),
(4001312, '', 'FLEBOTEK  NORMOGOTERO VET'),
(4001313, '', 'PISA MIX PLUS POLVO 10g/2g 5K'),
(4001319, '', 'NAPZIN Sol Iny. 50ml'),
(4001320, '', 'NAPZIN SOL INY 100ML VET'),
(4001321, '', 'PROCIN  SOL. INY. 25 ML VET'),
(4001323, '', 'NAPZIN 50mg/ml 250ml'),
(4001325, '', 'ENERCOL 0.018g/30ml Sol.InyVET'),
(4001326, '', 'NAPZIN SOL INY FCO 10 ML'),
(4001340, '', 'ECTOSIN 0.6% PREMIX 5KG PREMEZ'),
(4001342, '', 'PROCIN EQUUS SOL INY 50ml'),
(4001343, '', 'OXITOPISA 20UI S.I. 250ml VET'),
(4001842, '', 'PENBALEX LA Susp.Iny.250ml'),
(4001845, '', 'PENBALEX LA Susp.Iny. 100ml'),
(4001846, '', 'TOPAZONE AEROSOL PVL  250CC VET'),
(4001849, '', 'SEBACICLINA MF SOL INY 100 ml'),
(4001855, '', 'ELECTRODEX Pvo.p/Sol.Oral C/10kg'),
(4001964, '', 'BASETYL 200 SOL INY. 20% 250ml'),
(4002093, '', 'AMX LA SUSP INY 100 ML.'),
(4002103, '', 'NFL MAX PREMEZCLA 5Kg'),
(4002105, '', 'NFL MAX C/EXPEC PREMEZCLA 5Kg'),
(4002110, '', 'CALCIOSOL FORTE Iny. 100 ML'),
(4002111, '', 'CRIVOSIN VET  1MG  10 ML'),
(4002117, '', 'MAXIFOLIPOL 4% PREMEZCLA 25KG VET.'),
(4002331, '', 'CAREBUMINA 25%PREMEZCLA 4KG'),
(4002354, '', 'LINCOMINE 44 Premezcla 25Kg'),
(4002466, '', 'ECTOSIN  SoluciÇŸ¶ün oral 1L'),
(4002468, '', 'PENDIBEN COMPUESTO 50 MUI VET'),
(4002469, '', 'FOSFODICA  SOL.ORAL 1L VET'),
(4002471, '', 'FOSFODICA SOL. ORAL 20L VET'),
(4002472, '', 'NF 180 NFL SoluciÇŸ¶ün oral 2L'),
(4002473, '', 'NEUMOENTER PLUS Premezcla 6Kg'),
(4002474, '', 'AMX 50% POLVO SOLUBLE 500g  VET'),
(4002475, '', 'ELECTRODEX 180MG  C/5 SOBRES VET'),
(4002524, '', '\"NOVOX Manufacturado'),
(4002526, '', 'PRANTEL PUPPY SUSP ORAL 20 ML VET'),
(4002529, '', 'PIROFLOX PLUS SOL. INY. 250ML'),
(4002539, '', 'COCCITRAK 2.5 ( SOL 1 LT)VET'),
(4002540, '', '\"COCCITRAK 5.0%'),
(4002590, '', 'PIROFLOX PLUS 10% SOL ORAL 5L'),
(4002688, '', 'PISACAINA 2% C/EPINEFRINA VET 50ml.'),
(4002689, '', 'PISACAINA 2% VET 50ml.'),
(4002691, '', 'OTROZOL 500 VET Flexoval 100ml'),
(4002692, '', 'BEPLENOVAX VET 1000 ml'),
(4002821, '', '\"DIAMAL ROD'),
(4002822, '', '\"DIAMAL ROD'),
(4002823, '', 'PENTASTAR Shampoo pulgicida (250ml)'),
(4002824, '', 'PENTASTAR JabÇŸ¶ün pulgicida (Barra 80g)'),
(4002889, '', 'FUREAL N.F. (Urea 13.4 g) caja /50 bolos'),
(4002890, '', 'NF-180 N.F. (Norfloxacina 40mg) C/600Tab'),
(4002907, '', 'FURACINE NF SOL. TOPICA 3.5 L'),
(4002908, '', 'FURACINE NF SOL. TOPICA 500 ML'),
(4002910, '', 'TOPAZONE NF AEROSOL 400 ML'),
(4002927, '', 'VALSYN NF POLVO SOLUBLE CUBETA C/10KG'),
(4002928, '', 'VALSYN NF POLVO SOLUBLE 5G C/100 SOBRES'),
(4003036, '', 'FURACINE NF POMADA 453G'),
(4003037, '', 'FURACINE NF POMADA 85G'),
(4003115, '', 'CLOVIREL PREMEZ.SACO25KgVET'),
(4003116, '', '\"COCCILIBER 40% PREMEZCLA'),
(4003123, '', 'PROCINA Sol.Iny. 50ml'),
(4003156, '', 'NF-180 ST (P/TERNEROS REFORM.)C/200Bolos'),
(4003172, '', 'BASETYL MAX S.I. FRASCO 100ML VET'),
(4003173, '', 'BASETYL MAX S.I. FRASCO 250ML VET'),
(4003178, '', 'PISABENTAL 6.3% SOL.INY. 100ML'),
(4003216, '', 'RACMINA PREMIX (Ract.HCl 2%)Prem.C/10Kg'),
(4003231, '', ''),
(4003301, '', 'ZIPAMIX 4.8% PREMEZCLA ORAL SACO/10KG'),
(4003437, '', 'RACMINA PREMIX 10% Premez.Oral C/10Kg'),
(4005100, '', '\"NEUMOENTER PREMIX 20%'),
(4005137, '', 'PISACOX 12% PREMEZCLA SACO 25 KG'),
(4005161, '', 'PET SHINE  SHAMPOO SOLIDO  100GR VET'),
(4005328, '', 'PISAFLAM 50MG/ML SOL.INY. FCO.100ML'),
(4005702, '', 'MEGACLOX FG+ 140/20mg C/20 IMP'),
(4005703, '', 'MEGACLOX CR200 200/20mg C/20 IMP'),
(4005705, '', 'MEGACLOX BG6 40/8mg C/10 IMP'),
(4005722, '', 'SINATAQ 1L'),
(4005723, '', 'SINATAQ 100ML'),
(4005747, '', 'AMOXICLAV VET 875/125mg C/14 TAB VET'),
(4005748, '', 'AMOXICLAV   VET  POLVO P / SUSP  ORAL Fr'),
(4006203, '', 'GENTALEX  FUERTE SOL.INY. 5% FCO. 100ml'),
(4006598, '', 'SOL. HT FCO. PLAST 250 ml. VET.'),
(4006599, '', 'SOL. CS. 0.9% FCO. PLAST 250 ml. VET'),
(4006603, '', 'RANULIN  VET    Caja c/30  Tabletas'),
(4006604, '', 'RANULIN  VET  INYECTABLE  Fco.  50 ml.'),
(4006606, '', 'PIROFLOX TABLETAS 50 Mg. CAJA C/30 Tab.'),
(4006607, '', '4006306'),
(4006615, '', 'VITABECID Sol.Iny.100ml'),
(4006616, '', 'HORPROGES S.I 50mg/ml fco 10ml'),
(4006618, '', 'INDUPAR Sol.Iny 0.075mg/ml Fco.20ml'),
(4006619, '', 'RELINA500 fco. 50ml Sol.Iny 500mcg/5ml'),
(4006673, '', 'DIAMAL BLQ BROMADIOLONA 0.005% CBT5KG'),
(4007462, '', 'LARVOPEC 10mg/ml Sol Iny 500 ml'),
(4007465, '', 'TILMI 300 mg/ml Soln. Inyectable 100 ml'),
(4007468, '', 'PRANTEL PLUS Perros Grandes C/20 TABLETA'),
(4007469, '', 'ECTOSIN LA 31.5mg/ml fco. c/500ml'),
(4007472, '', 'PENBALEX AQUA SUSP INY. 250ML'),
(4007573, '', 'STOP  ON 10 X 60 ML VET'),
(4008355, '', 'VODEXATÇ?¶ÿ FCO AMP 50ML VET'),
(4008356, '', 'PRANTEL  PUPPY  Susp.  Oral  150ml.'),
(4008357, '', 'PISALIV  VET Fco. 15 ml. Sol. Oftalmica'),
(4008358, '', 'IRONHORSE SI 20mg/ml Caja C/10 Fcos 20ml'),
(4009947, '', 'PROTECTYL 40% PREMEZCLA 10Kg'),
(4009948, '', 'COCCIMAX 12% premezcla 25Kg'),
(4009953, '', 'DARBAZIN PASTA ORAL JGA C/32.4G VET'),
(4009954, '', 'EQUIPRAZOL PASTA ORAL 6.15g c/7Jering'),
(4009956, '', 'ECTOSIN EQUUS PLUS JERINGA 6.42g'),
(4009957, '', 'ECTOSIN EQUUS SIMPLE JERINGA 25ML'),
(4009959, '', 'COMPLENAY MO SOL INY FCO C/100ml VET'),
(4009960, '', 'COMPLENAY MO SOL INY FCO C/500ml VET'),
(4009964, '', 'PRANTEL PLUS C/20 TABLETAS'),
(4012635, '', 'AMX 60% PREMIX SACO C/25KG'),
(4013030, '', 'AMINO-LITE 34X iny.250MLplast.BOEHRINGER'),
(4013170, '', 'AGUA ESTERIL PISA 3 Lt VET'),
(4013730, '', 'TH4 SoluciÇŸ¶ün 1 Litro'),
(4013731, '', 'TH4 SoluciÇŸ¶ün 5 Litros'),
(4013732, '', 'TH4+ ENV. PLASTICO 10 Lt'),
(4013733, '', 'TH4+ ENV. PLASTICO 25 Lt'),
(4013734, '', 'TH4+ ENV. PLASTICO 60 Lt'),
(4013926, '', 'CLOXAPRAM 20 mg/ml FCO C/20 ml VET'),
(4013928, '', 'DOCARPINA 25mg FCO C/60 TAB VET'),
(4014048, '', 'EVITEMP 13.5/15.2% POLVO CJA C/25 SOB'),
(4014115, '', 'PRAMOTIL VET 5MG/ML S.I FCO AMP 50ml'),
(4014170, '', 'SOFLORAN   VET.  Fco.  Con  100ml.'),
(4014172, '', 'ANTIVON VET TAB 4 MG CJA C/10'),
(4014173, '', 'CLINDAPIS TABLETAS 150MG CJA C/20 VET'),
(4014232, '', 'RELAZEPAM VET 5mg/ml SOL INY FCO AMP10ml'),
(4014234, '', 'PISADOL 20 SOL INY FCO AMP C/20ml VET'),
(4014235, '', 'PISADOL 50 SOL INY FCO AMP C/50ml VET'),
(4014236, '', 'PISADOL 100mg SOL ORAL FCO GOT 10ml VET'),
(4014243, '', 'FIST GEL 0.05% GEL CUCARAC JGA C/30 gr'),
(4014244, '', 'TOTENFLI 1% CEBO EXH C/50 SOB 20gr C/U'),
(4014245, '', 'TOTENFLI 1% CEBO MOSQ TARRO 1 kg'),
(4014246, '', 'TOTENFLI 1% CEBO MOSQ TARRO 2 kg'),
(4014247, '', 'SINATAQ 40 PVO HUM EX C/25 SOB 10gr'),
(4014248, '', 'SINATAQ 40 PVO HUM TARRO C/250 gr'),
(4015032, '', 'CAREBUMINA 25% PREMEZCLA SACO C/25 kg'),
(4016292, '', 'FLOXACINE 100 mg S.I. FCO C/100 ml'),
(4017411, '', 'DOCARPINA 50 mg  FCO C/60 TAB VET'),
(4017412, '', 'DOCARPINA 100 mg FCO C/60 TAB VET'),
(4017433, '', 'SOLDRIN CLEAN OTIC 1.5%/.1% FCO C/120ml'),
(4017434, '', 'MELOCAXYL 1.5MG/ML SUS ORAL FCO C/10 ML'),
(4017435, '', 'MELOCAXYL 1.5mg/ml SUS ORAL FCO C/32 ml'),
(4017436, '', 'NFL MAX C/EXPEC PREMEZCLA 25Kg'),
(4017437, '', 'ESPIRANIDE CJA C/10 TAB'),
(4017503, '', 'AMINO-LITE 34X iny250MLVIDRIO BOEHRINGER'),
(4017595, '', 'TM POLVO SOL F/ANIMAL 25X200G (ZOETIS)Ç?¶ÿ'),
(4017596, '', 'TM POLVO SOL F/ANIMAL 20X50G (ZOETIS)Ç?¶ÿ Ç?¶ÿ'),
(4017597, '', 'TM POL SOL F/ANIMAL 25KG(5X5KG) (ZOETIS)'),
(4017600, '', 'TM POLVO SOL C/HIAMINA 20X50G (ZOETIS)Ç?¶ÿ'),
(4017856, '', ''),
(4018129, '', 'PETSHINE SPA BARRA JABON C/100g'),
(4018250, '', 'MAMISAN UNGÇŸ?ENTO 100G (ZOETIS)Ç?¶ÿ'),
(4018251, '', 'MAMISAN UNGÇŸ?ENTO 200G (ZOETIS)Ç?¶ÿ'),
(4018350, '', 'ZIROLARV PVO SOL 52.5% TARRO C/250 GR'),
(4021155, '', 'SOLUCION HT PISA 1000ml EXP COLOMBIA VET'),
(4021156, '', 'SOLUCION CS PISA 1000ml EXP COLOMBIA VET'),
(4021339, '', 'SOLUCION DX-50 PISA 500ml EXP COLOMB VET'),
(4021760, '', 'FLUFLOR XPECTRO S.I. 450MG/ML FCO 250ML'),
(4021761, '', 'CLINDAPIS SOL ORAL FCO C/20 ml VET'),
(4022035, '', 'NF-180 NFL 2% 10KG POLVO ORAL EXP CR VET'),
(4022057, '', 'NAPZIN SOL INY FCO 10 ml EXP CR VET'),
(4022058, '', 'NAPZIN SOL INY FCO 50 ML EXP CR VET'),
(4022059, '', 'NAPZIN  SOL INY FCO 100 ML EXP  VET'),
(4022504, '', 'ALNEX Sol. Iny. 250 ml VET NUPLEN'),
(4022506, '', '3 SULFAS Solucion Iny. 500 ml NUPLEN'),
(4022507, '', 'NAPZIN 50mg/ml 250ml NUPLEN'),
(4022508, '', 'SOL DX-50 Plas 500ml VET NUPLEN'),
(4022510, '', 'BEPLENOVAX S.I. FCO C/1000 ml VET NUPLEN'),
(4022511, '', 'BASETYL 200 SOL INY. 20% 250ml NUPLEN'),
(4022513, '', 'SEBACICLINA 50 SOL.INY. 500 ML NUPLEN'),
(4022515, '', '\"CALCIOSOL FORTE'),
(4022522, '', '\"ELECTRODEX BECERROS'),
(4022523, '', 'ACTYNOXEL RTU SUSP INY 250ml NUPLEN'),
(4022525, '', 'PIROFLOX 10% SOL INY 250ml NUPLEN'),
(4022527, '', 'HENEXAL VET 50mg/ml 10ml fco NUPLEN'),
(4022532, '', 'SOLUCION CS 7.5% S.I 1000mlVET NUPLEN'),
(4022534, '', 'SOL CS FLEX SI 1000ml VET NUPLEN'),
(4022539, '', 'GENTAERBA Solucion Iny. 100ml NUPLEN'),
(4022567, '', 'FLEBOTEK S/AGUJA VETERINARIO NUPLEN'),
(4023362, '', 'GENTAERBA Solucion Iny. 100ml PE.'),
(4023369, '', 'BEPLENOVAX iny.fco.1000 ml VET PE.'),
(4023370, '', 'CALCIOSOL CON FIJ. c/150 comp. PE.'),
(4023377, '', 'HENEXAL VET 50mg/ml 10ml fco PE.'),
(4023388, '', 'SOL CS Iny FLEXOVAL 500ml(Vet) PE.'),
(4023389, '', 'SOL CS 0.9% FCO. PLAST 250ML. VET. PE.'),
(4023394, '', 'SOL HARTMANN FCO. PLAST 250ML. VET. PE.'),
(4023403, '', 'FLEBOTEK CON ESPIRAL veterinario PE.'),
(4023404, '', 'FLEBOTEK s/aguja Veterinario PE.'),
(4023406, '', 'SOL CS FLEX S.Iny 1000ml VET PE.'),
(4023464, '', 'PISTOLA PARA IMPLANTES MEGACLOX'),
(4023468, '', 'DONEXENT 100mg CAJA C/100 TAB VET'),
(4024301, '', 'TOPAZONE NF AEROSOL 400 ML PROAN'),
(4024880, '', 'FERRITON 200 100ml C/12 fcos EXP CR VET'),
(4024881, '', 'NFL MAX C/EXPEC PREMEZCLA 5Kg EXP CR VET'),
(4031194, '', 'VALBAZEN 2.5% SUSP FCO 250ML (ZOETIS)'),
(4031195, '', 'VALBAZEN 2.5% SUSP FRASCO 1L (ZOETIS)'),
(4031372, '', 'RACMINA PREMIX 2% EXP COL'),
(4033794, '', 'MASSPERFORMANCE.EQU S.ORAL fco 3.785Lc/4'),
(4033795, '', 'MASSPERFORMANCE.YEG S.ORAL fco 3.785Lc/4'),
(4033796, '', 'MASSPERFORMANCE.MIN S.ORAL fco 3.785Lc/4'),
(4034846, '', 'NFL MAX CON EXPECTORANTE 25KG EXP GUA'),
(4034847, '', 'ACTYNOXEL RTU SUSP INY 250ml EXP GUA VET'),
(4036021, '', 'COCCITRAK 5% SUSPENSION 250ML EXP GUA'),
(4039539, '', 'AMX 60% PREMIX SACO C/25KG EXP COL'),
(4041761, '', 'AMINO-LITE 500ML INY. VIDRIO BOEHRINGER'),
(4043357, '', 'NFL MAX PREMEZCLA 25Kg'),
(4043970, '', 'ZIPAMIX 4.8% PRE ORAL SACO/5KG'),
(9000872, '', 'REBAJAS Y DESC. S/VENTAS NAC.'),
(9000901, '', 'REBAJAS Y DESC.S/VENTAS NAC. SIN IVA'),
(9000902, '', 'SERVICIO DE MAQUILAS'),
(9000904, '', 'DESCUENTO POR PRONTO PAGO SIN IVA'),
(9001899, '', 'DESCUENTOS PRONTO PAGO COBRANZA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_impuestos`
--

CREATE TABLE `producto_impuestos` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `base_traslado` float(10,2) DEFAULT NULL,
  `impuesto_traslado` float(10,2) DEFAULT NULL,
  `tipo_factor_traslado` varchar(50) DEFAULT NULL,
  `tasa_cuota_traslado` float(10,2) DEFAULT NULL,
  `importe_traslado` float(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto_impuestos`
--

INSERT INTO `producto_impuestos` (`id`, `id_producto`, `base_traslado`, `impuesto_traslado`, `tipo_factor_traslado`, `tasa_cuota_traslado`, `importe_traslado`) VALUES
(1, 4, 2699.90, 2.00, '0.00', 0.00, 0.00),
(2, 4, 0.04, 2.00, '0.00', 0.00, 0.00),
(3, 4, 478.28, 2.00, '0.00', 0.16, 76.52),
(4, 4, 982.63, 2.00, '0.00', 0.00, 0.00),
(11, 16, 94.88, 2.00, '0.00', 0.00, 0.00),
(12, 16, 365.48, 2.00, '0.00', 0.00, 0.00),
(13, 16, 133.12, 2.00, '0.00', 0.00, 0.00),
(14, 16, 849.75, 2.00, '0.00', 0.00, 0.00),
(15, 16, 37.31, 2.00, '0.00', 0.00, 0.00),
(16, 16, 87.50, 2.00, '0.00', 0.00, 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_validacion`
--

CREATE TABLE `producto_validacion` (
  `id` int(11) NOT NULL,
  `no_identificacion` varchar(50) NOT NULL,
  `unidad` varchar(50) NOT NULL,
  `clave_unidad` varchar(50) NOT NULL,
  `clave_prod_ser` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `cantidad` decimal(10,0) NOT NULL,
  `descuento` decimal(10,0) DEFAULT NULL,
  `importe` decimal(10,0) NOT NULL,
  `valor_unitario` decimal(10,0) NOT NULL,
  `estatus` enum('APROBADO','NO APROBADO','PENDIENTES') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2018-06-05 21:56:14', '2018-06-05 21:56:14'),
(2, 'user', 'User', '2018-06-05 21:56:14', '2018-06-05 21:56:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 1, 12, '2018-06-05 21:56:14', '2018-06-05 21:56:14'),
(7, 2, 13, '2018-06-11 13:47:52', '2018-06-11 13:47:52'),
(8, 2, 14, '2018-06-11 13:51:58', '2018-06-11 13:51:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(10) NOT NULL,
  `business_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('HOMBRE','MUJER') COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `burn_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_type` enum('RANCHO','CLINICA','GRANJA') COLLATE utf8mb4_unicode_ci NOT NULL,
  `rfc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `role_id`, `business_name`, `password`, `gender`, `phone`, `burn_date`, `address`, `email`, `business_type`, `rfc`, `remember_token`, `created_at`, `updated_at`) VALUES
(12, 'Natalia', 1, 'ninguno', '$2y$10$9WHen59TiUVne1QVemhyFe00uNru/cx7VWll/P5aJ4qt4PJecjBd2', 'MUJER', '3325412584', '02/02/2010', 'conocido 120', 'admin@example.com', 'RANCHO', 'CEGA920520G49', 't7Dba1A3lMe8dnX1G5vJ8cV58KZiBoqpEKli5OGyzYaTXDY2Xfn9YHqI1LXi', '2018-06-11 20:14:35', '2018-06-11 20:14:35'),
(13, 'Yadira', 2, 'ninguno', '$2y$10$9WHen59TiUVne1QVemhyFe00uNru/cx7VWll/P5aJ4qt4PJecjBd2', 'MUJER', '3325412584', '02/02/2010', 'conocido 120', 'user@example.com', 'RANCHO', 'CEGA920520G46', 'GReMvvQogI3LrUeUKGa1BF522tOkqaAoeIweUu4INZKlshJQJ9KmBBHyuDCz', '2018-06-11 20:18:14', '2018-06-11 20:18:14'),
(14, 'Nathaly', 1, 'ninguno', '$2y$10$P8viZFTSvBN6OMDzl85BjuuxHux3jcI7Dl23GHoftuVj.Pp40CX5K', 'MUJER', '3325412584', '02/02/2010', 'conocido 120', 'ncedeno@mindgroup.mx', 'RANCHO', 'CEGA920520G45', 'yh6NcHIrvcDQ2KQiaewU9saNow1fno7UJ9pLi2nKACcr6TLHjhCltCInMDVu', '2018-06-11 20:24:19', '2018-06-11 20:24:19'),
(15, 'Christian', 2, 'ninguno', '$2y$10$.HLaHiVCSW7Q/4z2fFGci.c8c2pS9CjvYefCCulbh1xTFyekFuHuq', 'MUJER', '3325412558', '02/02/2010', 'conocido 120', 'christian@example.com', 'GRANJA', 'CEGA920520G51', 'gy45MGkDT3UbY9LP3Gx4pGNitqblXDeba0GIQDlvn4BJYjEPHrBW02dXebTi', '2018-07-24 18:18:15', '2018-07-24 18:18:15'),
(17, 'Christian', 2, 'ninguno', '$2y$10$0bhqyzDzcorOs4chqFGwFeW2lLd2N5Jjv11sRABc4YnkycVg3uuKq', 'MUJER', '3325412584', '02/02/2010', 'conocido 120', 'christian@example.com', 'CLINICA', 'CEGA920520G50', '28xxggLX2p5RGcOYqku1vw8n0kAN8P5NHNxRmiwZBefuunmHxrUMr22NDdvb', '2018-07-24 20:07:46', '2018-07-24 20:07:46'),
(24, 'Christian', 2, 'ninguno', '$2y$10$I8m6bTz64d2F9C.IkorxXeNgoQzIPawakxboNEOOpL5RDA7lPcvpW', 'MUJER', '3325412584', '02/02/2010', 'conocido 120', 'christian@example.com', 'CLINICA', 'CEGA920520G48', NULL, '2018-07-26 01:28:07', '2018-07-26 01:28:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users1`
--

CREATE TABLE `users1` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `rfc` varchar(50) NOT NULL,
  `genero` varchar(191) NOT NULL,
  `fecha_nacimiento` varchar(191) NOT NULL,
  `celular` varchar(191) NOT NULL,
  `direccion` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users1`
--

INSERT INTO `users1` (`id`, `name`, `rfc`, `genero`, `fecha_nacimiento`, `celular`, `direccion`, `email`, `password`, `remember_token`, `updated_at`, `created_at`) VALUES
(1, 'Nathaly Cedeno', 'CEGY880225', 'Femenino', '25/02/1988', '6', 'moctezuma 854', 'ncedeno@mindgroup.com.mx', '$2y$10$6n.r3SHaZIbV2ZgveZNxQeazsh7lqO1Osje9icfjrljM.mwgsyI4y', NULL, '2018-05-15 18:41:09', '2018-05-15 18:41:09'),
(3, 'Yadira Cedeno', 'GEGY880225', 'Femenino', '25/02/1988', '10', 'moctezuma 854', 'ycedeno@mindgroup.com', '$2y$10$6xQxZ1.DFpOOraQY5SKjyOEjSbEYNnLV3PuZaBJ32HMKc6gCWBZ6K', 'cQhvqQHyvVU98FUWwYV9W5b0IvwgPjhykGLg47nsjIdB2PuDz3PZQLPgwDq7', '2018-05-17 17:53:33', '2018-05-17 17:53:33');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Índice 2` (`folio`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto_impuestos`
--
ALTER TABLE `producto_impuestos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto_validacion`
--
ALTER TABLE `producto_validacion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_identificacion` (`no_identificacion`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users1`
--
ALTER TABLE `users1`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Índice 2` (`rfc`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `producto_impuestos`
--
ALTER TABLE `producto_impuestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `producto_validacion`
--
ALTER TABLE `producto_validacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `users1`
--
ALTER TABLE `users1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
