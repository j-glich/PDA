DROP TABLE IF EXISTS `evidencia_cumplimiento`;
DROP TABLE IF EXISTS `producto`;
DROP TABLE IF EXISTS `subcategoria`;
DROP TABLE IF EXISTS `categoria`;
DROP TABLE IF EXISTS `rubro`;


CREATE TABLE `rubro` (
  `RB_CVE` varchar(3) NOT NULL COMMENT 'Contiene la clave de rubros, esta clave se genera con 3 caracteres. E.d.DOCENCIA=DOC, INVESTIGACION=INV, TUTORIA Y DIRECCION=TUD, GESTION ACADEMICA=GEA, CAPACITACION Y ACTUALIZACION=CAA',
  `RB_TITULO` varchar(150) DEFAULT NULL,
  `RB_DESCRIPCION` varchar(150) DEFAULT NULL,
  `RB_ACTIVO` char(1) DEFAULT 'A' COMMENT 'Estado del registro A=Activo, I=INACTIVO',
  `RB_FEC_INSERT` datetime DEFAULT CURRENT_TIMESTAMP,
  `RB_FEC_UPDATE` datetime DEFAULT NULL,
  `RB_LAST_IP` int unsigned DEFAULT NULL COMMENT 'Guarda la ultima dirección ip en formato númerico',
  `RB_BY_USER` int DEFAULT NULL COMMENT 'El usuario que realizó la ultima modificación',
  PRIMARY KEY (`RB_CVE`)
) ENGINE=InnoDB COMMENT='Contiene el catalogo de rubros';

--
-- Dumping data for table `rubro`
--
LOCK TABLES `rubro` WRITE;
/*!40000 ALTER TABLE `rubro` DISABLE KEYS */;
INSERT INTO `rubro` VALUES ('CAA','CAPACITACIÓN Y ACTUALIZACIÓN ','FORMACIÓN PROFESIONAL DISCIPLINARIA Y PEDAGÓGICA DEL PROFESOR ','A','2021-06-28 15:39:56','2022-04-25 15:11:35',2130706433,200),('DOC','DOCENCIA','DOCENCIA','A','2021-06-12 16:22:18','2022-04-25 15:13:20',2130706433,200),('EAC','ASESORÍA CIENCIAS BÁSICAS','Prueba','I','2022-04-25 15:01:12','2022-04-25 15:02:50',2130706433,200),('GEA','GESTION ACADÉMICA -VINCULACIÓN','GESTIÓN ACADÉMICA COLEGIADA, COLECTIVA DE GENERACI','A','2021-06-12 17:15:57','2021-06-13 00:15:28',NULL,NULL),('INV','INVESTIGACION','GENERACIÓN Y APLICACIÓN DEL CONOCIMIENTO','A','2021-06-12 16:22:18','2021-06-12 23:20:15',NULL,NULL),('TUD','TUTORÍA Y DIRECCIÓN INDIVIDUALIZADA DE ESTUDIANTES','TUTORÍAS','A','2021-06-12 16:22:18','2021-06-12 23:20:15',NULL,NULL);
/*!40000 ALTER TABLE `rubro` ENABLE KEYS */;
UNLOCK TABLES;


CREATE TABLE `categoria` (
  `CAT_CVE` varchar(4) NOT NULL COMMENT 'Contiene la clave de la categoria,  esta clave se genera con 3 caracteres. DOCENCIA IND= DOI, OTRAS ACTIVIDADES DOCENTES= OAD, GENERACION Y APLICACION= GEA, TUTORIAS= TUT, GESTION ACADEMICA COLEGIADA....=GCO, FORMACION PROFESIONAL DISCIPLINARIA Y PEDAGOGICA= FDP ',
  `CAT_CVE_RB` varchar(4) NOT NULL COMMENT 'Contiene la clave del rubro',
  `CAT_TITULO` varchar(160) DEFAULT NULL,
  `CAT_DESCRIPCION` varchar(160) DEFAULT NULL,
  `CAT_FEC_UPDATE` datetime DEFAULT NULL,
  `CAT_FEC_INSERT` datetime DEFAULT CURRENT_TIMESTAMP,
  `CAT_ACTIVO` char(1) DEFAULT 'A' COMMENT 'Status del regustros: A=Activo, I=Inacivo.\\\\\\\\n',
  `CAT_BY_USER` int DEFAULT NULL COMMENT 'Guarda la ultima dirección ip en formato númerico',
  `CAT_LAST_IP` int unsigned DEFAULT NULL COMMENT 'Guarda la ultima dirección ip en formato númerico',
  PRIMARY KEY (`CAT_CVE`),
  KEY `FK_CAT_CVE_RB_idx` (`CAT_CVE_RB`),
  CONSTRAINT `FK_CAT_CVE_RB` FOREIGN KEY (`CAT_CVE_RB`) REFERENCES `rubro` (`RB_CVE`)
) ENGINE=InnoDB COMMENT='Contiene las actividades de cada rubro';


--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES ('DOI','DOC','DOCENCIA ','Docencia frente a grupo, Asesoría ciencias básicas, Asesoria de Especialidad, Otras actividades. 2','2022-05-11 11:54:28','2021-06-28 15:54:17','A',200,2130706433),('FDP','CAA','FORMACIÓN PROFESIONAL DISCIPLINARIA Y PEDAGÓGICA DEL PROFESOR','Cursos de actualización profesional','2021-09-15 15:31:07','2021-06-28 15:52:41','A',200,2130706433),('GAC','INV','GENERACIÓN Y APLICACIÓN DEL CONOCIMIENTO','Realización directa de proyectos de investigación, Redacción y publicación de artíiculos, Impartición de conferencias y seminarios.','2021-06-28 15:52:41','2021-06-28 15:52:41','A',NULL,NULL),('GCO','GEA','GESTIÓN ACADÉMICA COLEGIADA, COLECTIVA DE GENERACIÓN Y APLICACIÓN DEL CONOCIMIENTO, ACADÉMICA PERSONAL, VINCULACIÓN Y DIFUSIÓN ','Academia, Vinculación con el sector productivo, social y de servicios.','2021-06-28 15:52:41','2021-06-28 15:52:41','A',NULL,NULL),('TUT','TUD','TUTORÍAS','Programa de tutoría,Dirección de tésis, Tutoría de residencia','2021-06-28 15:52:41','2021-06-28 15:52:41','A',NULL,NULL);
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;



DROP TABLE IF EXISTS `subcategoria`;

CREATE TABLE `subcategoria` (
  `SCAT_CVE` varchar(3) NOT NULL COMMENT 'Contiene la clave de la categoria,  esta clave se genera con 3 caracteres. ASESORIA ACADEMICA= ASA, INSTRUMENTACION DIDACTICA= IDI, PREPARACION DE CURSOS= PCU, ELABORACION DE PROYECTOS = EPR, REDACCION Y REPARACION = RRE, INVESTIGACION=INV, DESARROLLO TECNOLOGICO=DTE, TUTORIA DE ESTUDIANTES= TES, DIRECCION DE TESIS=DTE, TUTORIA Y RESIDENCIA PROFESIONAL=TRP,  DISEÑO Y ADECUACION CURRICULAR= DAC, COMITE DEL SISTEMA..=CGE, ACADEMIAS=ACA, COORDINACION Y SUPERVISION...=CSP, APOYO A TALLERES Y LABORATORIOS=ATL, CONGRESO=CON, ELABORACION PLAN DESARROLLO=EPD, FORMACION EN PROGRAMA..=FPD, PROGRAMAS DE CAPACITACION DISCIPLINARIAS...=PCD',
  `SCAT_CVE_CAT` varchar(3) DEFAULT NULL COMMENT 'Contiene la clave de la categoria',
  `SCAT_TITULO` varchar(150) DEFAULT NULL,
  `SCAT_DESCRIPCION` varchar(450) DEFAULT NULL,
  `SCAT_ACTIVO` char(1) DEFAULT 'A' COMMENT 'Estado del registro A=Activo, I=Inactivo, F=Finalizo Periodo',
  `SCAT_FEC_UPDATE` datetime DEFAULT NULL,
  `SCAT_FEC_INSERT` datetime DEFAULT CURRENT_TIMESTAMP,
  `SCAT_BY_USER` int DEFAULT NULL,
  `SCAT_LAST_IP` int unsigned DEFAULT NULL,
  PRIMARY KEY (`SCAT_CVE`),
  KEY `FK_SCAT_CVE_CAT_idx` (`SCAT_CVE_CAT`),
  CONSTRAINT `FK_SCAT_CVE_CAT` FOREIGN KEY (`SCAT_CVE_CAT`) REFERENCES `categoria` (`CAT_CVE`)
) ENGINE=InnoDB COMMENT='Contiene las acciones de trabajo de cata categoría. 	';


--
-- Dumping data for table `subcategoria`
--

LOCK TABLES `subcategoria` WRITE;
/*!40000 ALTER TABLE `subcategoria` DISABLE KEYS */;
INSERT INTO `subcategoria` VALUES ('ACA','GCO','ACADEMIA','a) Programa de reuniones (Presidente),\r b) Plan de trabajo con propuestas de los integrantes (Presidente)  , \r c) Asistencia a reuniones de academia  \r, d) Asignación y seguimientos de actividades especificas asignadas ,\r e) Elaboración de actas de academia (Secretario)\r , f) Presenta Informe semestral de trabajo correspondientes a los periodos de gestión (Presidente) ','A',NULL,'2022-03-24 15:03:52',NULL,NULL),('ASE','DOI','ASESORÍA CIENCIAS BÁSICAS.','a) Recibe la asignación emitida por el o la coordinador(a) de asesorías academicas ,\r b) Diseña el plan de acción asesorías académicas\r, c) Brinda asesoría académica,\r d) Entrega formato de satisfacción del cliente\r, e) Elabora y entrega reporte de los resultados de asesorías ','A',NULL,'2022-03-24 13:54:06',NULL,NULL),('CAC','FDP','CURSOS DE ACTUALIZACIÓN PROFESIONAL','a) Inscripción a curso de actualización \r, b) Asiste al curso de actualización,\r c) Aprueba curso de actualización\r, d) Prepara material para replicar curso recibido\r ,e) Replica curso a personal docente del ITSOEH','A',NULL,'2022-03-24 15:08:58',NULL,NULL),('DFG','DOI','DOCENCIA FRENTE A GRUPO','a) Implementa la instrumentación didáctica de las asignaturas,\r b) Diseña carta de acuerdos por asignatura.\r, c) Diseño de instrumentos de evaluación.\r, d) Define causas y acciones con base al reporte estadístico institucional\r ,e) Captura de calificaciones conforme al calendario escolar.','A',NULL,'2022-03-24 13:47:22',NULL,NULL),('DTS','TUT','DIRECCIÓN DE TESIS','a) Revisa propuesta de proyecto de tésis\r, b) Establece plan de trabajo\r, c) Da Seguimiento de la ejecución del plan de trabajo,\r d) Revisa e indica correcciones,\r e) Libera proyecto de tésis','A',NULL,'2022-03-24 14:44:02',NULL,NULL),('ESP','DOI','ASESORÍA DE ESPECIALIDAD','a) Recibe la asignación emitida por el o la coordinador(a) de asesorías academicas, \r b) Diseña el plan de acción asesorías académicas\r, c) Brinda asesoría académica\r, d) Entrega formato de satisfacción del cliente\r, e) Elabora y entrega reporte de los resultados de asesorías','A',NULL,'2022-03-24 13:56:04',NULL,NULL),('IMC','GAC','IMPARTICIÓN DE CONFERENCIAS Y SEMINARIOS','a) Atiende solicitud de invitación \r, b) Prepara material de conferencia y/o seminario\r, c) Imparte conferencia y/o seminario\r, d) Realiza encuesta de satisfacción de conferencia y/o seminario','A',NULL,'2022-03-24 15:02:13',NULL,NULL),('OTR','DOI','OTRAS ACTIVIDADES','a) Prepara material de apoyo a la docencia\r, b) Participa en programas de formación propia con fines docentes.','A',NULL,'2022-03-24 14:36:27',NULL,NULL),('PRT','TUT','PROGRAMA DE TUTORÍA','a) Elabora el plan de trabajo tutorial,\r b) Ejecuta el plan de trabajo tutorial,\r c) Elabora el plan de acción tutorial *\r ','A',NULL,'2022-03-24 14:42:09',NULL,NULL),('RDP','GAC','REALIZACIÓN DIRECTA DE PROYECTOS DE INVESTIGACIÓN','a) Entrega oficio de solicitud de participación (interno o externo),\r b) Entrega formatos avalados por la academia del P.E.\r, c) Realiza programa de adquisición de materiales (POA)\r, d) Elabora solicitud de materiales con o sin financiamiento\r, e) Desarrolla proyecto\r, f) Entrega de informes técnicos-financeros de avance y final','A',NULL,'2022-03-24 14:59:22',NULL,NULL),('RPU','GAC','REDACCIÓN Y PUBLICACIÓN DE ARTÍCULOS','a) Envía resumen de articulo para su aceptación , b) Envia artículo para su revisión ,\r c) Atiende  observaciones de corrección\r ,d) Envía articulo corregido para su validación\r, e) Paga cuota de publicación\r, f) Presenta ponencia ','A',NULL,'2022-03-24 15:00:34',NULL,NULL),('TUR','TUT','TUTORÍA DE RESIDENCIA','a) Realiza plan de trabajo de actividades del o la residente\r, b) Visita a residente\r, c) Da seguimiento de la ejecución del plan de trabajo\r, d) Revisión y evaluación reporte de residencia','A',NULL,'2022-03-24 14:54:42',NULL,NULL),('VSP','GCO','VINCULACIÓN CON EL SECTOR PRODUCTIVO, SOCIAL Y DE SERVICIOS','a) Atiende solicitud de vinculación,\r b) Visita al sector solicitante,\r c) Realiza análisis y genera propuesta,\r d) Presenta propuesta al sector para su aceptación,\r e) Desarrolla el proyecto,\r f) Presenta productos resultantes de la vinculación\r ','A',NULL,'2022-03-24 15:06:32',NULL,NULL);
/*!40000 ALTER TABLE `subcategoria` ENABLE KEYS */;
UNLOCK TABLES;


DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `PR_CVE` varchar(4) NOT NULL,
  `PR_SCAT_CVE` varchar(3) DEFAULT NULL COMMENT 'Contiene la clave de subcategoria',
  `PR_TITULO` varchar(150) DEFAULT NULL,
  `PR_DESCRIPCION` varchar(150) DEFAULT NULL COMMENT 'Contiene la descripción de la actividad a realizar',
  `PR_DEFAULT` char(1) DEFAULT 'S' COMMENT 'Expresa si la actividad es obligatoria para la carga de las actividades \nE = describe que es producto Especifico  S = Si es obligatorio  N = No obligatorio P = de producto obligatorio que contendra el numero total de horas por subcategoria ',
  `PR_ACTIVO` char(1) DEFAULT 'A' COMMENT 'Estado del registro: A=Activo, I=Inactivo',
  `PR_FEC_INSERT` datetime DEFAULT CURRENT_TIMESTAMP,
  `PR_FEC_UPDATE` datetime DEFAULT NULL,
  `PR_LAST_IP` int unsigned DEFAULT NULL,
  `PR_BY_USER` int DEFAULT NULL,
  `PR_DIAS_ENTREGA` int DEFAULT NULL COMMENT 'Contendrá el número de días que se puede entregar la evídencia, es si se entrega diez días despues de la fecha del semestre, entonces contiene un valor de 10. Así se puede obtener desde la fecha de incio del periodo.',
  `PR_RE_PE` varchar(4) DEFAULT NULL COMMENT 'Este campo permite la relacion del producto especifico con el producto por default solo los productos especificos contendran este campo los demas productos se cargan para todos los docente.',
  PRIMARY KEY (`PR_CVE`),
  KEY `FK_SCAT_CVE` (`PR_SCAT_CVE`),
  CONSTRAINT `FK_PR_SCAT_CVE` FOREIGN KEY (`PR_SCAT_CVE`) REFERENCES `subcategoria` (`SCAT_CVE`)
) ENGINE=InnoDB COMMENT='Contiene items entregables, estos son los que se deberán evidenciar.';


--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES ('1101','DFG','IMPLEMENTA LA INSTRUMENTACIÓN DIDÁCTICA DE LAS ASIGNATURAS','INSTRUMENTACIÓN DIDÁCTICA VALIDADA','S','A','2022-03-26 10:01:39',NULL,2130706433,200,40,NULL),('1102','DFG','DISEÑA CARTA DE ACUERDOS POR ASIGNATURA','CARTA DE ACUERDOS VALIDADA ','S','A','2022-03-26 10:04:14',NULL,2130706433,200,200,NULL),('1103','DFG','DISEÑO DE INSTRUMENTOS DE EVALUACIÓN','INSTRUMENTOS DE EVALUACIÓN (LISTAS DE COTEJO, CUESTIONARIO, ETC).','S','A','2022-03-26 10:06:12',NULL,2130706433,200,80,NULL),('1104','DFG','DEFINE CAUSAS Y ACCIONES CON BASE AL REPORTE ESTADISTICO INSTITUCIONAL','REPORTE DE ANÁLISIS DE CAUSAS Y ACCIONES AL PROCESO Y PRODUCTO','S','A','2022-03-26 10:10:01',NULL,2130706433,200,150,NULL),('1105','DFG','CAPTURA DE CALIFICACIONES CONFORME AL CALENDARIO ESCOLAR.','ACTA DE CALIFICACIONES (IMPRESIÓN DE PATALLA O FÍSICO DEL CONECT).    ','P','A','2022-03-26 10:11:55',NULL,2130706433,200,129,NULL),('1106','DFG','Ejemplo de de preguntas egel','Ejemplo de preguntas egel con opción multiple ','E','A','2022-03-28 10:31:42',NULL,2130706433,200,20,'1103'),('1107','DFG','Prueba de producto especifico ','Este producto especifico ','E','A','2022-03-30 20:05:19',NULL,2130706433,200,120,'1101'),('1108','DFG','preguntas egl 2','cvsdvdvsdf','E','A','2022-05-11 12:22:50',NULL,2130706433,200,40,'1103'),('1109','PRT','Formato de Evaluación docente','contiene todos los archivos de los estudiante ','E','A','2022-05-11 18:27:30',NULL,2130706433,200,20,'2103'),('1201','ASE','RECIBE LA ASIGNACIÓN EMITIDA POR EL O LA COORDINADOR(A) DE ASESORÍAS ACADEMICAS ','OFICIO DE ASIGNACIÓN ','P','A','2022-03-26 10:14:48',NULL,2130706433,200,150,NULL),('1202','ASE','DISEÑA EL PLAN DE ACCIÓN ASESORÍAS ACADÉMICAS','PLAN DE ACCIÓN DE ASESORÍA ACADÉMICA','S','A','2022-03-26 10:16:30',NULL,2130706433,200,80,NULL),('1203','ASE','BRINDA ASESORÍA ACADÉMICA','BITÁCORA Y LISTAS DE ASISTENCIAS Y EVIDENCIAS DE ASESORÍA','S','A','2022-03-26 10:20:00',NULL,2130706433,200,80,NULL),('1204','ASE','ENTREGA FORMATO DE SATISFACCIÓN DEL CLIENTE','FORMATO DE SATISFACCIÓN DEL CLIENTE DEBIDAMENTE REQUISITADO','S','A','2022-03-26 10:22:33',NULL,2130706433,200,150,NULL),('1205','ASE','ELABORA Y ENTREGA REPORTE DE LOS RESULTADOS DE ASESORÍAS','REPORTE DE ASESORÍAS ACADÉMICAS','S','A','2022-03-26 10:24:28',NULL,2130706433,200,80,NULL),('1301','ESP','RECIBE LA ASIGNACIÓN EMITIDA POR EL O LA COORDINADOR(A) DE ASESORÍAS ACADEMICAS ','OFICIO DE ASIGNACIÓN ','P','A','2022-03-26 11:56:55',NULL,NULL,NULL,NULL,NULL),('1302','ESP','DISEÑA EL PLAN DE ACCIÓN ASESORÍAS ACADÉMICAS','PLAN DE ACCIÓN DE ASESORÍA ACADÉMICA','S','A','2022-03-26 11:56:55',NULL,NULL,NULL,NULL,NULL),('1303','ESP','BRINDA ASESORÍA ACADÉMICA','BITÁCORA Y LISTAS DE ASISTENCIAS Y EVIDENCIAS DE ASESORÍA','S','A','2022-03-26 11:56:55',NULL,NULL,NULL,NULL,NULL),('1304','ESP','ENTREGA FORMATO DE SATISFACCIÓN DEL CLIENTE','FORMATO DE SATISFACCIÓN DEL CLIENTE DEBIDAMENTE REQUISITADO','S','A','2022-03-26 11:56:55',NULL,NULL,NULL,NULL,NULL),('1305','ESP','ELABORA Y ENTREGA REPORTE DE LOS RESULTADOS DE ASESORÍAS','REPORTE DE ASESORÍAS ACADÉMICAS','S','A','2022-03-26 11:56:55',NULL,NULL,NULL,NULL,NULL),('1401','OTR','PREPARA MATERIAL DE APOYO A LA DOCENCIA','MATERIALES DE APOYO (ANTOLOGIAS, MANUAL DE PRÁCTICAS, PROBLEMARIOS, ETC.)','P','A','2022-03-26 12:03:02',NULL,2130706433,200,80,NULL),('1402','OTR','PARTICIPA EN PROGRAMAS DE FORMACIÓN PROPIA CON FINES DOCENTES.','CARTA SOLICITUD DE HORAS DE APOYO PARA   POSGRADO Y BOLETA DE CALIFICACIONES','S','A','2022-03-26 12:04:19',NULL,2130706433,200,80,NULL),('2101','PRT','ELABORA EL PLAN DE TRABAJO TUTORIAL','PLAN DE TRABAJO TUTORIAL VALIDADO ','P','A','2022-03-26 12:29:26',NULL,2130706433,200,15,NULL),('2102','PRT','EJECUTA EL PLAN DE TRABAJO TUTORIAL','REPORTE DE SEGUIMIENTO DE TUTORÍA VALIDADO','S','A','2022-03-26 12:32:07',NULL,2130706433,200,80,NULL),('2103','PRT','ELABORA EL PLAN DE ACCIÓN TUTORIAL * ','*APLICA CONFORME A LO ESTABLECIDO EN EL LINEAMIENTO DEL TECNM','S','A','2022-03-26 12:33:47',NULL,2130706433,200,40,NULL),('2201','DTS','REVISA PROPUESTA DE PROYECTO DE TÉSIS','PROPUESTA','P','A','2022-03-26 12:42:15',NULL,2130706433,200,80,NULL),('2202','DTS','ESTABLECE PLAN DE TRABAJO','PLAN DE TRABAJO VALIDADO','S','A','2022-03-26 12:43:07',NULL,2130706433,200,100,NULL),('2203','DTS','DA SEGUIMIENTO DE LA EJECUCIÓN DEL PLAN DE TRABAJO','REPORTE DE AVANCE','S','A','2022-03-26 12:44:24',NULL,2130706433,200,150,NULL),('2204','DTS','REVISA E INDICA CORRECCIONES','REPORTE DE AVANCE','S','A','2022-03-26 12:46:06',NULL,2130706433,200,80,NULL),('2205','DTS','LIBERA PROYECTO DE TÉSIS','PROTOCOLO DE Y ACTA DE TITULACIÓN','S','A','2022-03-26 12:49:15',NULL,2130706433,200,40,NULL),('2301','TUR','REALIZA PLAN DE TRABAJO DE ACTIVIDADES DEL O LA RESIDENTE','PLAN DE TRABAJO','P','A','2022-03-26 12:52:29',NULL,2130706433,200,80,NULL),('2302','TUR','VISITA A RESIDENTE','OFICIO DE COMISIÓN Y REPORTE DE VISITA','S','A','2022-03-26 12:54:55',NULL,2130706433,200,40,NULL),('2303','TUR','DA SEGUIMIENTO DE LA EJECUCIÓN DEL PLAN DE TRABAJO','FORMATO DE EVALUACIÓN Y SEGUIMIENTO DE RESIDENCIA CON CALIFICACIONES','S','A','2022-03-26 12:56:20',NULL,2130706433,200,80,NULL),('2304','TUR','REVISIÓN Y EVALUACIÓN REPORTE DE RESIDENCIA','FORMATO DE EVALUACIÓN DEL REPORTE DE RESIDENCIA PROFESIONAL CON CALIFICACIONES','S','A','2022-03-26 12:57:45',NULL,2130706433,200,80,NULL),('3101','RDP','ENTREGA OFICIO DE SOLICITUD DE PARTICIPACIÓN (INTERNO O EXTERNO)','OFICIO DE SOLICITUD DE PARTICIPACIÓN (INTERNO O EXTERNO)','P','A','2022-03-26 13:04:35',NULL,2130706433,200,40,NULL),('3102','RDP','ENTREGA FORMATOS AVALADOS POR LA ACADEMIA DEL P.E.','FORMATOS AVALADOS POR LA ACADEMIA DEL P.E.','S','A','2022-03-26 13:06:08',NULL,2130706433,200,80,NULL),('3103','RDP','REALIZA PROGRAMA DE ADQUISICIÓN DE MATERIALES (POA)',' PROGRAMA DE ADQUISICIÓN DE MATERIALES (POA)','S','A','2022-03-26 13:06:55',NULL,2130706433,200,40,NULL),('3104','RDP','ELABORA SOLICITUD DE MATERIALES CON O SIN FINANCIAMIENTO','SOLICITUD DE MATERIALES CON O SIN FINANCIAMIENTO','S','A','2022-03-26 13:08:00',NULL,2130706433,200,150,NULL),('3105','RDP','DESARROLLA PROYECTO','EVIDENCIA DEL DESARROLLO DE PROYECTO','S','A','2022-03-26 13:10:18',NULL,2130706433,200,40,NULL),('3106','RDP','ENTREGA DE INFORMES TÉCNICOS-FINANCEROS DE AVANCE Y FINAL','INFORMES TÉCNICOS-FINANCEROS DE AVANCE Y FINAL','S','A','2022-03-26 13:11:19',NULL,2130706433,200,80,NULL),('3201','RPU','ENVÍA RESUMEN DE ARTICULO PARA SU ACEPTACIÓN ','RESUMEN DE ARTICULO ','P','A','2022-03-26 13:19:45',NULL,2130706433,200,80,NULL),('3202','RPU','ENVIA ARTÍCULO PARA SU REVISIÓN ','ARTÍCULO ENVIADO ','S','A','2022-03-26 13:21:30',NULL,2130706433,200,40,NULL),('3203','RPU','ATIENDE OBSERVACIONES DE CORRECCIÓN','ARICULO ACEPTADO ','S','A','2022-03-26 13:23:15',NULL,2130706433,200,150,NULL),('3204','RPU','ENVÍA ARTICULO CORREGIDO PARA SU VALIDACIÓN','ARICULO ACEPTADO','S','A','2022-03-26 13:24:12',NULL,2130706433,200,150,NULL),('3205','RPU','PAGA CUOTA DE PUBLICACIÓN','COMPROBANTE DE PAGO DE PUBLICACIÓN DE ARTICULO ','S','A','2022-03-26 13:25:51',NULL,2130706433,200,40,NULL),('3206','RPU','PRESENTA PONENCIA','CONSTANCIA DE PONENCIA IMPARTIDA','S','A','2022-03-26 13:26:30',NULL,2130706433,200,80,NULL),('3301','IMC','ATIENDE SOLICITUD DE INVITACIÓN ','SOLICITUD DE INVITACIÓN ','P','A','2022-03-26 13:30:01',NULL,2130706433,200,80,NULL),('3302','IMC','PREPARA MATERIAL DE CONFERENCIA Y/O SEMINARIO','ESTRUCTURA TEMARIO Y MATERIAL DE CONFERENCIA Y/O SEMINARIO','S','A','2022-03-26 13:31:08',NULL,2130706433,200,80,NULL),('3303','IMC','IMPARTE CONFERENCIA Y/O SEMINARIO','CONSTANCIA DE CONFERENCIA IMPARTIDA Y/O SEMINARIO','S','A','2022-03-26 13:32:18',NULL,2130706433,200,40,NULL),('3304','IMC','REALIZA ENCUESTA DE SATISFACCIÓN DE CONFERENCIA Y/O SEMINARIO','ENCUESTA DE SATISFACCIÓN DE CONFERENCIA Y/O SEMINARIO','S','A','2022-03-26 13:33:06',NULL,2130706433,200,40,NULL),('4101','ACA','PROGRAMA DE REUNIONES (PRESIDENTE)','PROGRAMA VALIDADO','P','A','2022-03-26 13:39:15',NULL,2130706433,200,80,NULL),('4102','ACA','PLAN DE TRABAJO CON PROPUESTAS DE LOS INTEGRANTES (PRESIDENTE)   ','PLAN DE TRABAJO VALIDADO DE ACUERDO A LAS ACTIVIDADES ESTABLECIDAS EN EL LINEAMIENTO PARA LA INTEGRACIÓN Y OPERACIÓN DE LAS ACADEMIAS DEL TECNM','S','A','2022-03-26 13:39:53',NULL,2130706433,200,150,NULL),('4103','ACA','ASISTENCIA A REUNIONES DE ACADEMIA  ','LISTA ASISTENCIA','S','A','2022-03-26 13:40:38',NULL,2130706433,200,40,NULL),('4104','ACA','ASIGNACIÓN Y SEGUIMIENTOS DE ACTIVIDADES ESPECÍFICAS ASIGNADAS ','SEGUIMIENTO Y REVISIÓN DE EVIDENCIAS ESTABLECIDAS EN EL LINEAMIENTO PARA LA INTEGRACIÓN Y OPERACIÓN DE LAS ACADEMIAS DEL TECNM','S','A','2022-03-26 13:41:48',NULL,2130706433,200,40,NULL),('4105','ACA','ELABORACIÓN DE ACTAS DE ACADEMIA (SECRETARIO)','ACTAS DE ACADEMIA','S','A','2022-03-26 13:42:22',NULL,2130706433,200,80,NULL),('4106','ACA','PRESENTA INFORME SEMESTRAL DE TRABAJO CORRESPONDIENTES A LOS PERIODOS DE GESTIÓN (PRESIDENTE)','INFORME','S','A','2022-03-26 13:46:54',NULL,2130706433,200,200,NULL),('4201','VSP','ATIENDE SOLICITUD DE VINCULACIÓN','MINUTA DE REUNIÓN CON EL SECTOR SOLICITANTE','P','A','2022-03-26 13:48:50',NULL,2130706433,200,80,NULL),('4202','VSP','VISITA AL SECTOR SOLICITANTE','REPORTE DE VISITA DE CAMPO','S','A','2022-03-26 13:50:33',NULL,2130706433,200,80,NULL),('4203','VSP','REALIZA ANÁLISIS Y GENERA PROPUESTA','PROPUESTA DE VINCULACIÓN','S','A','2022-03-26 13:53:01',NULL,2130706433,200,80,NULL),('4204','VSP','PRESENTA PROPUESTA AL SECTOR PARA SU ACEPTACIÓN','EXPOSICIÓN DE LA PROPUESTA AL SECTOR SOLICITANTE','S','A','2022-03-26 13:55:10',NULL,2130706433,200,150,NULL),('4205','VSP','DESARROLLA EL PROYECTO','REPORTE DE AVANCES','S','A','2022-03-26 13:55:43',NULL,2130706433,200,80,NULL),('4206','VSP','PRESENTA PRODUCTOS RESULTANTES DE LA VINCULACIÓN ','INFORME, MAQUETA, PROYECTO, PROTOTIPOS, IDEA, ETC.','S','A','2022-03-26 13:56:50',NULL,2130706433,200,80,NULL),('5101','CAC','INSCRIPCIÓN A CURSO DE ACTUALIZACIÓN ','CONSTANCIA Y PAGO DE INSCRIPCIÓN ','P','A','2022-03-26 13:59:01',NULL,2130706433,200,100,NULL),('5102','CAC','ASISTE AL CURSO DE ACTUALIZACIÓN','CONSTANCIA DE ASISTENCIA','S','A','2022-03-26 14:00:09',NULL,2130706433,200,80,NULL),('5103','CAC','APRUEBA CURSO DE ACTUALIZACIÓN','DIPLOMA O CONSTANCIA DE ACREDITACIÓN DEL CURSO','S','A','2022-03-26 14:01:47',NULL,2130706433,200,80,NULL),('5104','CAC','PREPARA MATERIAL PARA REPLICAR CURSO RECIBIDO','MATERIAL PARA REPLICAR CURSO RECIBIDO','S','A','2022-03-26 14:02:30',NULL,2130706433,200,80,NULL),('5105','CAC','REPLICA CURSO A PERSONAL DOCENTE DEL ITSOEH','ENCUESTA DE SATISFACCIÓN APLICADO A DOCENTES','S','A','2022-03-26 14:04:26',NULL,2130706433,200,300,NULL);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;


CREATE TABLE `evidencia_cumplimiento` (
  `EC_CVE` int NOT NULL AUTO_INCREMENT,
  `EC_PR_CVE` varchar(4) DEFAULT NULL COMMENT 'Clave del producto',
  `EC_DOCENTE_CVE` int DEFAULT NULL COMMENT 'Contiene la clave del docente al que se le asigna la actividad',
  `EC_PERIODO_CVE` varchar(5) DEFAULT NULL COMMENT 'Contiene la clave del periodo',
  `EC_HRS_CUMPLIMIENTO` int DEFAULT '0' COMMENT 'Especifica las horas en las que desarrolla el producto.',
  `EC_FECHA_PROGRAMADA` datetime DEFAULT NULL COMMENT 'Es el computo de la fecha de la fecha programada, apartir de la fecha de incio del periodo mas los días de cumplimiento de la acción o subcategoría.',
  `EC_FECHA_CUMPLIMIENTO` datetime DEFAULT NULL COMMENT 'Es la fecha en la que cargo la evidencia\\n',
  `EC_TIEMPO` char(1) DEFAULT 'S' COMMENT 'Estado de cumplimiento en tiempo. Valores S=Sí N=No, P=Prorroga.\\\\n ',
  `EC_FORMA` char(1) DEFAULT 'S' COMMENT 'Estado de cumplimiento en forma. Valores S=Sím N=No, P=Prorroga.\\n ',
  `EC_OBSERVACIONES` varchar(200) DEFAULT NULL COMMENT 'Contiene las observaciones dadas para una segunda revision',
  `EC_RUTA` varchar(100) DEFAULT NULL COMMENT 'Contiene la ruta a la evidencia o el detalle de la evidencia. ',
  `EC_GRADO_CUMPLIMIENTO` char(1) DEFAULT NULL COMMENT 'Estado del cumplimiento de 1 a 5.\\n',
  `EC_USUARIO_EVALUADOR` int DEFAULT NULL COMMENT 'Contiene la clave del usuario que realiza la evaluacion',
  `EC_ACTIVO` char(1) DEFAULT 'A' COMMENT 'Contiene si el campo esta activo o inactivo A=Activo, I=Inactivo, C=Cerrado',
  `EC_FEC_INSERT` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Contiene la fecha de insercion de registro',
  `EC_FEC_UPDATE` datetime DEFAULT NULL COMMENT 'Contiene la fecha de actualizacion del registro',
  `EC_LAST_IP` int unsigned DEFAULT NULL COMMENT 'Contiene la IP del usuario que ha realizado la última operación',
  `EC_BY_USER` int DEFAULT NULL COMMENT 'Usuario que realiza la operación',
  `EC_PR_OC` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`EC_CVE`),
  KEY `FK_DOCENTE_CVE` (`EC_DOCENTE_CVE`),
  KEY `FK_PERIODO_CVE` (`EC_PERIODO_CVE`),
  KEY `FK_PR_CVE` (`EC_PR_CVE`),
  CONSTRAINT `EC_PR_CVE` FOREIGN KEY (`EC_PR_CVE`) REFERENCES `producto` (`PR_CVE`),
  CONSTRAINT `FK_DOCENTE_CVE` FOREIGN KEY (`EC_DOCENTE_CVE`) REFERENCES `docente` (`DO_CVE_DOCENTE`),
  CONSTRAINT `FK_PERIODO_CVE` FOREIGN KEY (`EC_PERIODO_CVE`) REFERENCES `periodo` (`PE_CVE`)
) ENGINE=InnoDB AUTO_INCREMENT=1467 COMMENT='Contiene la evidencia de cunplimiento por';


--
-- Dumping data for table `evidencia_cumplimiento`
--

LOCK TABLES `evidencia_cumplimiento` WRITE;
/*!40000 ALTER TABLE `evidencia_cumplimiento` DISABLE KEYS */;
INSERT INTO `evidencia_cumplimiento` VALUES (1435,'4101',18,'20221',10,'2022-03-31 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-06 12:54:24',NULL,2130706433,200,NULL),(1436,'4102',18,'20221',0,'2022-06-09 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'I','2022-05-06 12:54:24',NULL,2130706433,200,NULL),(1437,'4103',18,'20221',0,'2022-02-19 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'I','2022-05-06 12:54:24',NULL,2130706433,200,NULL),(1438,'4104',18,'20221',0,'2022-02-19 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'I','2022-05-06 12:54:24',NULL,2130706433,200,NULL),(1439,'4105',18,'20221',0,'2022-03-31 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'I','2022-05-06 12:54:24',NULL,2130706433,200,NULL),(1440,'4106',18,'20221',0,'2022-07-29 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'I','2022-05-06 12:54:24',NULL,2130706433,200,NULL),(1441,'1101',18,'20221',0,'2022-02-19 00:00:00','2022-05-06 12:57:53','N','N','No cumple satisfactoriamente','https://docs.google.com/document/d/1fQKbh1ws2LxmKFNpvzFJ8u5L394XhfKlDcidb-62jTQ/edit?usp=sharing','3',200,'I','2022-05-06 12:54:24','2022-05-06 13:11:08',2130706433,200,NULL),(1442,'1102',18,'20221',0,'2022-07-29 00:00:00','2022-05-09 11:19:22','S','S',NULL,'https://docs.google.com/document/d/1fQKbh1ws2LxmKFNpvzFJ8u5L394XhfKlDcidb-62jTQ/edit?usp=sharing',NULL,NULL,'A','2022-05-06 12:54:24','2022-05-09 11:19:22',2130706433,200,NULL),(1443,'1103',18,'20221',0,'2022-03-31 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-06 12:54:24',NULL,2130706433,200,NULL),(1444,'1104',18,'20221',0,'2022-06-09 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-06 12:54:24',NULL,2130706433,200,NULL),(1445,'1105',18,'20221',400,'2022-05-19 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-06 12:54:24',NULL,2130706433,200,NULL),(1446,'2101',18,'20221',2,'2022-01-25 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-06 12:54:24',NULL,2130706433,200,NULL),(1447,'2102',18,'20221',0,'2022-03-31 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-06 12:54:24',NULL,2130706433,200,NULL),(1448,'2103',18,'20221',0,'2022-02-19 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-06 12:54:24',NULL,2130706433,200,NULL),(1449,'1101',1008,'20221',0,'2022-02-19 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-11 11:58:45',NULL,2130706433,200,NULL),(1450,'1102',1008,'20221',0,'2022-07-29 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-11 11:58:45',NULL,2130706433,200,NULL),(1451,'1103',1008,'20221',0,'2022-03-31 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-11 11:58:45',NULL,2130706433,200,NULL),(1452,'1104',1008,'20221',0,'2022-06-09 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-11 11:58:45',NULL,2130706433,200,NULL),(1453,'1105',1008,'20221',800,'2022-05-19 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-11 11:58:45',NULL,2130706433,200,NULL),(1454,'1201',194,'20221',80,'2022-06-09 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-11 18:29:56',NULL,2130706433,200,NULL),(1455,'1202',194,'20221',0,'2022-03-31 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-11 18:29:56',NULL,2130706433,200,NULL),(1456,'1203',194,'20221',0,'2022-03-31 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-11 18:29:56',NULL,2130706433,200,NULL),(1457,'1204',194,'20221',0,'2022-06-09 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-11 18:29:56',NULL,2130706433,200,NULL),(1458,'1205',194,'20221',0,'2022-03-31 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-11 18:29:56',NULL,2130706433,200,NULL),(1459,'1101',194,'20221',0,'2022-02-19 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-11 18:29:56',NULL,2130706433,200,NULL),(1460,'1102',194,'20221',0,'2022-07-29 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-11 18:29:56',NULL,2130706433,200,NULL),(1461,'1104',194,'20221',0,'2022-06-09 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-11 18:29:56',NULL,2130706433,200,NULL),(1462,'1105',194,'20221',400,'2022-05-19 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-11 18:29:56',NULL,2130706433,200,NULL),(1463,'1106',194,'20221',0,'2022-01-30 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-11 18:29:56',NULL,2130706433,200,NULL),(1464,'2101',194,'20221',20,'2022-01-25 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-11 18:29:56',NULL,2130706433,200,NULL),(1465,'2102',194,'20221',0,'2022-03-31 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-11 18:29:56',NULL,2130706433,200,NULL),(1466,'1109',194,'20221',80,'2022-01-30 00:00:00',NULL,'S','S',NULL,NULL,NULL,NULL,'A','2022-05-11 18:29:56',NULL,2130706433,200,NULL);
/*!40000 ALTER TABLE `evidencia_cumplimiento` ENABLE KEYS */;
UNLOCK TABLES;
-- Dumping routines for database 'indicadores'
--
/*!50003 DROP PROCEDURE IF EXISTS `so_up_fecha_doc` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `so_up_fecha_doc`(
up_doc_cve int,
up_fecha_programada datetime
)
BEGIN

UPDATE `indicadores`.`evidencia_cumplimiento`
SET
`EC_FECHA_PROGRAMADA` = up_fecha_programada,
`EC_FECHA_CUMPLIMIENTO`= DATE_ADD(up_fecha_programada, INTERVAL 10 DAY)
WHERE `EC_DOCENTE_CVE` = up_doc_cve;
END ;;
DELIMITER ;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_carga_evidencia_doc`(
in_docente_cve int,
in_ruta_evidencia varchar(100)
)
BEGIN

INSERT INTO `indicadores`.`evidencia_cumplimiento`
(
`EC_DOCENTE_CVE`,
`EC_RUTA`,
`EC_FEC_INSERT`
)
VALUES
(
in_docente_cve,
in_ruta_evidencia,
current_timestamp()
);
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_cierre_evaluacion` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_cierre_evaluacion`(
up_doc_cve int,
up_activo char(1) 
)
BEGIN

UPDATE `indicadores`.`evidencia_cumplimiento`
SET `EC_ACTIVO` = up_activo 
WHERE `EC_DOCENTE_CVE` = up_doc_cve;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_evaluar` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_evaluar`( 
in_producto varchar(4),
in_doc_cve int,
periodo_cve varchar(10),
up_tiempo char(1),
up_forma char(1),
up_observaciones varchar(250),
up_activo char(1),
up_grado_cumplimiento int,
up_usuario_evaluador int
)
BEGIN

UPDATE `indicadores`.`evidencia_cumplimiento`
SET
`EC_PERIODO_CVE` = periodo_cve,
`EC_TIEMPO` = up_tiempo,
`EC_FORMA` = up_forma,
`EC_OBSERVACIONES` = up_observaciones,
`EC_ACTIVO` = up_activo,
`EC_GRADO_CUMPLIMIENTO` = up_grado_cumplimiento,
`EC_USUARIO_EVALUADOR` = up_usuario_evaluador
WHERE `EC_DOCENTE_CVE` = in_doc_cve and  `EC_PR_CVE` = in_producto ;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_in_actividad` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_in_actividad`(
in_docente_cve int,
in_pr_cve varchar(4),
in_periodo varchar(5),
in_hrs_pr int,
in_ip varchar(15),
in_user int
)
BEGIN
DECLARE inicio_semestre date;
DECLARE dias_entrega int;
DECLARE in_fecha_programada date;
		SELECT pr_dias_entrega INTO dias_entrega FROM producto WHERE pr_cve = in_pr_cve;
		SELECT pe_fecha_inicio INTO inicio_semestre FROM periodo WHERE pe_activo = 'A';
	    SET in_fecha_programada=DATE_ADD(inicio_semestre, INTERVAL dias_entrega DAY);
INSERT INTO `indicadores`.`evidencia_cumplimiento`
(`EC_DOCENTE_CVE`,
`EC_PR_CVE`,
`EC_PERIODO_CVE`,
`EC_HRS_CUMPLIMIENTO`,
`EC_FECHA_PROGRAMADA`,
`EC_LAST_IP`,
`EC_BY_USER`
)
VALUES
(in_docente_cve,
in_pr_cve,
in_periodo,
in_hrs_pr,
in_fecha_programada,
inet_aton(in_ip),
in_user
);
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_in_actividad2` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_in_actividad2`(
in_docente_cve int,
in_pr_cve varchar(4),
in_hrs_pr int,
in_fecha_programada date,
in_ip varchar(15),
in_user int)
BEGIN
declare id_periodo varchar(10);
set id_periodo =(select P.PE_CVE from indicadores.periodo P where P.PE_ACTIVO = 'A');
INSERT INTO `indicadores`.`evidencia_cumplimiento`
(`EC_DOCENTE_CVE`,
`EC_PR_CVE`,
`EC_PERIODO_CVE`,
`EC_HRS_CUMPLIMIENTO`,
`EC_FECHA_PROGRAMADA`,
`EC_LAST_IP`,
`EC_BY_USER`
)
VALUES
(in_docente_cve,
in_pr_cve,
id_periodo,
in_hrs_pr,
in_fecha_programada,
inet_aton(in_ip),
in_user
);
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_in_actividades_generales` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_in_actividades_generales`(
in_ec_cve int,
in_pr_cve varchar(4),
in_docente_cve int
)
BEGIN

INSERT INTO `indicadores`.`evidencia_cumplimiento`
(`EC_CVE`,
`EC_PR_CVE`,
`EC_DOCENTE_CVE`)
VALUES
(in_ec_cve,
in_pr_cve,
in_docente_cve);
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_in_carga_actividad_x_producto` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_in_carga_actividad_x_producto`(
	in_cargaH varchar(1000), 
    in_docente int,
    in_periodo varchar(10),
    in_usuario int,
    in_ip varchar(15)
)
BEGIN 
		# Variables nesesarias para el funcionamiento del sistema
		DECLARE finished INTEGER DEFAULT 0;
		DECLARE f_pr_cve varchar(4) DEFAULT "";
		DECLARE ext_scat_cve VARCHAR(4); 
		DECLARE num_productos INT DEFAULT 0; 
		DECLARE iteraciones INT DEFAULT 0; 
		DECLARE product_and_horas varchar(8);
        DECLARE lim_superior INT DEFAULT 0;
		#se obtiene el numero de producto cargados y el nume maximo de caracteres
        SET num_productos = (length(in_cargaH) + 1) div 8;
		SET lim_superior =  (length(in_cargaH) + 1);
#ciclo que recorre por el numero de producto insertados
		WHILE iteraciones < num_productos DO 
        #declaramos variables para cada iteracion para obtener el prodcuto y recortar el producto siguiente
			SET product_and_horas = substring(in_cargaH, 1, 7);  
            SET in_cargaH = substring(in_cargaH, 9, lim_superior);
          
BEGIN 
			#Separar las variables independientes de las varible que cotiene el producto con las horas de carga
             DECLARE in_producto varchar(4) DEFAULT substring(product_and_horas, 1, 4);
             DECLARE num_horas int DEFAULT convert(substring(product_and_horas, 5, 7), signed integer);
             #Se crea el cursor mediante la consulta al producto 
             DEClARE cur_pr
				CURSOR FOR 
					SELECT p.pr_cve pr_cve FROM producto p where p.PR_CVE = in_producto ;
			DECLARE CONTINUE HANDLER 
            FOR NOT FOUND SET finished = 1;
			OPEN cur_pr; 
			carga_actividad: LOOP
				FETCH cur_pr INTO f_pr_cve;
				IF finished = 1 THEN 
					LEAVE carga_actividad;
				END IF;
				SELECT in_producto;
                call indicadores.sp_in_actividad(in_docente, f_pr_cve, in_periodo, num_horas,in_ip, in_usuario);
			END LOOP carga_actividad;
		CLOSE cur_pr;
             
			END;
              SET finished = 0;
              SET iteraciones = iteraciones+1;
	end while;
    
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_in_carga_actividad_x_scat` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_in_carga_actividad_x_scat`(
	in_cargaH varchar(100), 
    in_docente int,
    in_periodo varchar(10),
    in_usuario int,
    in_ip varchar(15)
)
BEGIN 
		   DECLARE finished INTEGER DEFAULT 0;
		   DECLARE f_pr_cve varchar(4) DEFAULT "";

		   DECLARE ext_scat_cve VARCHAR(4); 
		DECLARE num_scat INT DEFAULT 0; 
		DECLARE iteraciones INT DEFAULT 0; 
		DECLARE subcategoria varchar(6);
        DECLARE  lim_superior INT DEFAULT 0;

			

SET num_scat = (length(in_cargaH) + 1) div 7;
SET lim_superior = (length(in_cargaH) + 1);



		WHILE iteraciones < num_scat DO 
			SET subcategoria = substring(in_cargaH, 1, 6);  
            SET lim_superior =  (length(in_cargaH) + 1);
            SET in_cargaH = substring(in_cargaH, 8, lim_superior);
          
            





BEGIN 
			
            
             DECLARE in_scat_cve varchar(3) DEFAULT substring(subcategoria, 1, 3);
             DECLARE num_horas int DEFAULT convert(substring(subcategoria, 4, 6), signed integer);
			DEClARE cur_pr_x_scat  
				CURSOR FOR 
					SELECT p.pr_cve pr_cve FROM producto p
					JOIN subcategoria s ON s.scat_cve=p.pr_scat_cve 
					AND s.scat_cve=upper(in_scat_cve)
					ORDER BY s.scat_cve;
				
                
			
			DECLARE CONTINUE HANDLER 
				FOR NOT FOUND SET finished = 1;
		
			OPEN cur_pr_x_scat; 

			carga_actividad: LOOP
				FETCH cur_pr_x_scat INTO f_pr_cve;
				IF finished = 1 THEN 
					LEAVE carga_actividad;
				END IF;
                
				
				SELECT in_scat_cve;
                call indicadores.sp_in_actividad(in_docente, f_pr_cve, in_periodo, num_horas,in_ip, in_usuario);
			END LOOP carga_actividad;
		CLOSE cur_pr_x_scat;
				
     END;
     SET finished = 0;
    
     SET iteraciones = iteraciones+1;
	end while;
    
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_in_carga_pr_esp` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_in_carga_pr_esp`(
in_SCAT_CVE varchar(3),
in_producto_re varchar(4),
in_titulo varchar(150),
in_descripcion varchar(150),
in_ip varchar(15),
in_user int,
in_diasEntrega int
)
BEGIN
declare new_id int;
set new_id = (SELECT PR_CVE FROM subcategoria SUB join producto PR 
on (SUB.SCAT_CVE = PR.PR_SCAT_CVE) where SUB.SCAT_CVE ="DFG" ORDER BY PR.PR_CVE DESC LIMIT 1)+1;
INSERT INTO `indicadores`.`producto`
(`PR_CVE`,`PR_SCAT_CVE`,`PR_TITULO`,`PR_DESCRIPCION`,`PR_LAST_IP`,`PR_BY_USER`,`PR_DIAS_ENTREGA`,`PR_DEFAULT`,`PR_RE_PE`)
VALUES
(new_id,in_SCAT_CVE,in_titulo,in_descripcion,inet_aton(in_ip),in_user,in_diasEntrega,'E',in_producto_re);

 select * from indicadores.subcategoria SB join indicadores.producto PR  on(SB.SCAT_CVE = PR.PR_SCAT_CVE) where PR_CVE = new_id;

END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_in_carga_pr_especifico` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_in_carga_pr_especifico`(
in_subclave varchar(3),
in_titulo varchar(150),
in_desc varchar(150),
in_ip varchar(15),
in_user int,
in_diasEntrega int,
in_horas_pr int)
BEGIN
declare categoria varchar(3);
declare new_id int;
set categoria = (select SCAT_CVE_CAT from indicadores.subcategoria where SCAT_CVE = in_subclave);
set new_id = (SELECT PR_CVE FROM categoria CA join subcategoria SUB 
on(CA.CAT_CVE = SUB.SCAT_CVE_CAT) join producto PR 
on (SUB.SCAT_CVE = PR.PR_SCAT_CVE) where CA.CAT_CVE =categoria ORDER BY PR.PR_CVE DESC LIMIT 1) +1;
INSERT INTO `indicadores`.`producto`
(`PR_CVE`,`PR_SCAT_CVE`,`PR_TITULO`,`PR_DESCRIPCION`,`PR_LAST_IP`,`PR_BY_USER`,`PR_DIAS_ENTREGA`,`PR_DEFAULT`,`PR_HORAS_DESCARGA`)
VALUES
(new_id,in_subclave,in_titulo,in_desc,inet_aton(in_ip),in_user,in_diasEntrega,'E',in_horas_pr);

select * from indicadores.producto where PR_CVE = new_id;

END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_in_categoria` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_in_categoria`(
in_cve varchar(3),
in_titulo varchar(160),
in_descripcion varchar(400),
in_ip varchar(15),
in_user int
)
BEGIN

INSERT INTO `indicadores`.`categoria`
(`CAT_CVE`,
`CAT_TITULO`,
`CAT_DESCRIPCION`,
`CAT_LAST_IP`,
`CAT_BY_USER`)
VALUES
(in_cve,
in_titulo,
in_descripcion,
inet_aton(in_ip),
in_user);
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_in_docente` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_in_docente`(
in_cve_doc int,
in_nombre varchar(100),
in_grado varchar(50),
in_cedula int,
in_estudios varchar(100),
in_experiencia double,
in_docencia double,
in_categoria varchar(50),
in_num_empleado int,
in_contraseña varchar(32)
)
BEGIN

INSERT INTO `indicadores`.`docente`
(`DO_CVE_DOCENTE`,
`DO_NOMBRE`,
`DO_GRADO`,
`DO_CEDULA`,
`DO_ESTUDIOS`,
`DO_EXPERIENCIA`,
`DO_DOCENCIA`,
`DO_CATEGORIA`,
`DO_NUM_EMPLEADO`,
`DO_CONTRASENA`)
VALUES
(in_cve_doc,
in_nombre,
in_grado,
in_cedula,
in_estudios,
in_experiencia,
in_docencia,
in_categoria,
in_num_empleado,
in_contraseña);
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_in_evaluacion_x_docente` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_in_evaluacion_x_docente`(
	in_cargaH varchar(10000), 
    in_docente int,
    in_num_productos int,
    in_periodo varchar(10),
    in_usuario int,
    in_activo char(1),
    in_ip varchar(15)
)
BEGIN 
		# Variables nesesarias para el funcionamiento del sistema
		DECLARE finished INTEGER DEFAULT 0;
		DECLARE f_pr_cve varchar(4) DEFAULT "";
		DECLARE ext_scat_cve VARCHAR(4); 
		DECLARE num_productos INT DEFAULT 0; 
		DECLARE iteraciones INT DEFAULT 0; 
		DECLARE product varchar(260);
        DECLARE Cum_Tiempo varchar(260);
		DECLARE Cum_Forma varchar(260);
		DECLARE tam_car_observaciones  int;
        DECLARE lim_superior INT DEFAULT 0;
		#se obtiene el numero de producto cargados y el nume maximo de caracteres
        SET num_productos = in_num_productos ;
		SET lim_superior =  (length(in_cargaH) + 1);
#ciclo que recorre por el numero de producto insertados
		WHILE iteraciones < num_productos DO 
        #declaramos variables para cada iteracion para obtener el prodcuto y recortar el producto siguiente
		    SET tam_car_observaciones = substring(in_cargaH, 7, 2); 
            SET product = substring(in_cargaH, 1, 8 + CONVERT(tam_car_observaciones,UNSIGNED INTEGER) + 1);  
            SET in_cargaH = substring(in_cargaH, 8 + CONVERT(tam_car_observaciones,UNSIGNED INTEGER) + 3, lim_superior);  
BEGIN 
			#Separar las variables independientes de las varible que cotiene el producto con las horas de carga
           
             DECLARE in_producto varchar(4) DEFAULT substring(product, 1, 4);
             DECLARE in_cum_tiempo char(1) DEFAULT substring(product, 5,1);
             DECLARE in_cum_forma char(1) DEFAULT substring(product, 6,1);
			 DECLARE in_observaciones char(250) DEFAULT substring(product, 9, CONVERT(tam_car_observaciones,UNSIGNED INTEGER));
			DECLARE in_grado_cumplimiento char(1) DEFAULT substring(product, 9 + CONVERT(tam_car_observaciones,UNSIGNED INTEGER) , 1);
             #DECLARE num_horas int DEFAULT convert(substring(product_and_horas, 5, 7), signed integer);
			#select in_producto , in_cum_tiempo, in_cum_forma ,tam_car_observaciones , in_cargaH  ;
            DEClARE cur_pr_x_evaluacion_docente  
				CURSOR FOR 
				SELECT EC_PR_CVE FROM evidencia_cumplimiento EC where EC_PR_CVE = in_producto and EC_DOCENTE_CVE = in_docente;
			DECLARE CONTINUE HANDLER 
				FOR NOT FOUND SET finished = 1;
		
			OPEN cur_pr_x_evaluacion_docente; 

			carga_actividad: LOOP
				FETCH cur_pr_x_evaluacion_docente INTO f_pr_cve;
				IF finished = 1 THEN 
					LEAVE carga_actividad;
				END IF;
				SELECT in_producto;
                call indicadores.sp_pda_in_evaluar(f_pr_cve,in_docente,in_periodo,in_cum_tiempo,in_cum_forma,in_observaciones,in_activo,in_grado_cumplimiento,in_usuario,in_ip);
			END LOOP carga_actividad;
		CLOSE cur_pr_x_evaluacion_docente;
			END;
              SET finished = 0;
              SET iteraciones = iteraciones+1;
	end while;
    
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_in_evaluar_evidencia_docente` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_in_evaluar_evidencia_docente`(
in_id_producto varchar(4),
in_tiempo char(1) ,
in_forma char(1),
in_observaciones varchar(200),
in_ip varchar(15),
in_user int,
in_docente int)
BEGIN
UPDATE `indicadores`.`evidencia_cumplimiento`
SET
`EC_TIEMPO` = in_tiempo,
`EC_FORMA` = in_forma,
`EC_OBSERVACIONES` = in_observaciones ,
`EC_FEC_UPDATE` = now(),
`EC_LAST_IP` =  inet_aton(in_ip),
`EC_BY_USER` = in_user
WHERE `EC_CVE` = in_id_producto and EC_DOCENTE_CVE = in_docente ;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_in_nCategoria` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_in_nCategoria`(
in_cve varchar(3),
in_rb_clave varchar(3),
in_titulo varchar(50),
in_descripcion varchar(400),
in_ip varchar(15),
in_user int
)
BEGIN
INSERT INTO `indicadores`.`categoria`
(`CAT_CVE`,
`CAT_CVE_RB`,
`CAT_TITULO`,
`CAT_DESCRIPCION`,
`CAT_BY_USER`,
`CAT_LAST_IP`)
VALUES
(in_cve,
in_rb_clave,
in_titulo,
in_descripcion,
inet_aton(in_ip),
in_user);
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_in_periodo` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_in_periodo`(
in_pe_cve varchar(10),
in_fecha_inicio date,
in_fecha_fin date,
in_anio varchar(4),
in_descripcion varchar(50),
in_ip varchar(15),
in_user int
)
BEGIN

INSERT INTO `indicadores`.`periodo`
(`PE_CVE`,
`PE_FECHA_INICIO`,
`PE_FECHA_FIN`,
`PE_ANIO`,
`PE_DESCRIPCION`,
`PE_LAST_IP`,
`PE_BY_USER`)
VALUES
(in_pe_cve,
in_fecha_inicio,
in_fecha_fin,
in_anio,
in_descripcion,
inet_aton(in_ip),
in_user);
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_in_producto` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_in_producto`(
in_prclave varchar(4),
in_subclave varchar(3),
in_titulo varchar(150),
in_descripcion varchar(150),
in_ip varchar(15),
in_user int,
in_diasEntrega int
)
BEGIN
INSERT INTO `indicadores`.`producto`
(`PR_CVE`,
`PR_SCAT_CVE`,
`PR_TITULO`,
`PR_DESCRIPCION`,
`PR_LAST_IP`,
`PR_BY_USER`,
`PR_DIAS_ENTREGA`)
VALUES
(in_prclave,in_subclave,in_titulo,in_descripcion,inet_aton(in_ip),in_user,in_diasEntrega);


END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_in_rubro` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_in_rubro`(
in_cve varchar(3),
in_titulo varchar(50),
in_descripcion varchar(150),
in_ip varchar(15),
in_user int
)
BEGIN


INSERT INTO `indicadores`.`rubro`
(`RB_CVE`,
`RB_TITULO`,
`RB_DESCRIPCION`,
`RB_LAST_IP`,
`RB_BY_USER`)
VALUES
(in_cve,
in_titulo,
in_descripcion,
inet_aton(in_ip),
in_user);

END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_in_scat` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_in_scat`(
in_cve varchar(3),
in_titulo varchar(50),
in_descripcion varchar(100),
in_user int,
in_ip varchar(15)
)
BEGIN

INSERT INTO `indicadores`.`subcategoria`
(`SCAT_CVE`,
`SCAT_TITULO`,
`SCAT_DESCRIPCION`,
`SCAT_BY_USER`,
`SCAT_LAST_IP`)
VALUES
(in_cve,
in_titulo,
in_descripcion,
in_user,
inet_aton(in_ip));
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_in_subcategoria` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_in_subcategoria`(
in_SCAT_CVE varchar(3),
in_SCAT_CVE_CAT varchar(3),
in_titulo varchar(150),
in_descripcion varchar(150),
in_ip varchar(15),
in_user int
)
BEGIN
INSERT INTO `indicadores`.`subcategoria`
(`SCAT_CVE`,
`SCAT_CVE_CAT`,
`SCAT_TITULO`,
`SCAT_DESCRIPCION`,
`SCAT_BY_USER`,
`SCAT_LAST_IP`)
VALUES
(in_SCAT_CVE,
in_SCAT_CVE_CAT,
in_titulo,
in_descripcion,
in_user,
inet_aton(in_ip));
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_li_calculo_fecha_producto` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_li_calculo_fecha_producto`(in pr_cve varchar(4))
BEGIN
declare fecha_inicio datetime;
declare nume_dias int;

set fecha_inicio =(select P.PE_FECHA_INICIO from indicadores.periodo P where P.PE_ACTIVO = 'A');
set nume_dias = (select PR.PR_DIAS_ENTREGA from indicadores.producto PR where PR.PR_CVE = pr_cve);
select date_add(fecha_inicio, interval nume_dias day) AS Fecha ;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_li_categoria` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_li_categoria`(
)
BEGIN
SELECT `CAT_CVE`,
    `CAT_TITULO`,
    `CAT_DESCRIPCION`,
    `CAT_ACTIVO`
    
FROM `indicadores`.`categoria`
  WHERE  (`CAT_ACTIVO` =  'A') order by CAT_CVE;

END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_li_categorias_cargadas_x_docente` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_li_categorias_cargadas_x_docente`(in_id_docente int)
BEGIN
select distinct SCAT_CVE_CAT , CAT_CVE_RB from evidencia_cumplimiento EC join producto PR on(EC.EC_PR_CVE = PR.PR_CVE) 
join subcategoria SB on(PR.PR_SCAT_CVE = SB.SCAT_CVE) join categoria CA on(SB.SCAT_CVE_CAT = CA.CAT_CVE) where EC_DOCENTE_CVE = in_id_docente;  


END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_li_cat_x_cve` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_li_cat_x_cve`(
in_cve varchar(4)
)
BEGIN
SELECT CAT_CVE, CAT_TITULO, CAT_DESCRIPCION 
	from categoria
    where CAT_CVE=in_cve;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_li_docentes` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_li_docentes`(
)
BEGIN
SELECT `docente`.`DO_CVE_DOCENTE` cve,
     `docente`.`DO_NOMBRE_1` nom1,
    `docente`.`DO_GRADO` grado,
    `docente`.`DO_CEDULA` cedula
FROM `indicadores`.`docente`
  WHERE  (`DO_ACTIVO` =  'A');

END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_li_evidecia_x_docente` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_li_evidecia_x_docente`(in_do_cve_docente int,in_periodo_cve int)
BEGIN
select * from indicadores.evidencia_cumplimiento
join producto on EC_PR_CVE = PR_CVE
 where EC_DOCENTE_CVE=in_do_cve_docente 
 and EC_PERIODO_CVE =in_periodo_cve and EC_ACTIVO = 'A'
 order by  EC_PR_CVE;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_li_evidecia_x_docente_x_subc` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_li_evidecia_x_docente_x_subc`(in_do_cve_docente int,in_periodo_cve int)
BEGIN
select distinct PR_SCAT_CVE, SCAT_TITULO from indicadores.evidencia_cumplimiento
join producto on EC_PR_CVE = PR_CVE join subcategoria 
on PR_SCAT_CVE = SCAT_CVE
 where EC_DOCENTE_CVE=in_do_cve_docente 
 and EC_PERIODO_CVE =in_periodo_cve and EC_ACTIVO = 'A'
 order by  EC_PR_CVE;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_li_ev_doc_productos` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_li_ev_doc_productos`(in_do_cve_docente int,in_periodo_cve int , in_id_sub varchar(3))
BEGIN
select * from indicadores.evidencia_cumplimiento
join producto on EC_PR_CVE = PR_CVE join subcategoria 
on PR_SCAT_CVE = SCAT_CVE join categoria 
on SCAT_CVE_CAT = CAT_CVE  join rubro
on CAT_CVE_RB = RB_CVE
 where EC_DOCENTE_CVE=in_do_cve_docente 
 and EC_PERIODO_CVE =in_periodo_cve and EC_ACTIVO = 'A' 
 and  SCAT_CVE = in_id_sub
 order by  EC_PR_CVE;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_li_periodo` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_li_periodo`(
li_cve varchar(10)
)
BEGIN

SELECT *
FROM `indicadores`.`periodo`
  WHERE  (`PE_CVE` =  li_cve) ;

END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_li_periodos` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_li_periodos`()
BEGIN
SELECT * FROM `indicadores`.`periodo`;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_li_producto` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_li_producto`(
)
BEGIN
SELECT `PR_CVE`,
    `PR_SCAT_CVE`,
    `PR_TITULO`,
    `PR_DESCRIPCION`,
    `PR_ACTIVO`
    
FROM `indicadores`.`producto`
  WHERE  (`PR_ACTIVO` =  'A');

END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_li_producto_x_docente_sub` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_li_producto_x_docente_sub`(
in_subcategoria varchar(3),
in_cve_docente int,
in_cve_periodo varchar(10)
)
BEGIN
select * from evidencia_cumplimiento EC join producto PR 
on EC.EC_PR_CVE = PR.PR_CVE 
where PR_SCAT_CVE = in_subcategoria and EC_PERIODO_CVE = in_cve_docente
and EC_PERIODO_CVE = in_cve_periodo ;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_li_producto_x_scat` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_li_producto_x_scat`(
in_subcategoria varchar(3)
)
BEGIN


SELECT * FROM producto p
JOIN subcategoria s ON s.scat_cve=p.pr_scat_cve 
AND s.scat_cve=upper(in_subcategoria)
ORDER BY s.scat_cve;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_li_producto_x_titulo` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_li_producto_x_titulo`(
in_descripcion varchar(100)
)
BEGIN

SELECT r.rb_cve, 
r.rb_titulo, 
c.cat_cve, 
c.cat_titulo, 
s.scat_cve, 
s.scat_titulo, 
p.pr_cve, 
p.pr_titulo, 
p.pr_dias_entrega, 
p.pr_descripcion 
FROM producto p
JOIN subcategoria s ON s.scat_cve=p.pr_scat_cve 
AND s.scat_activo= 'A'
JOIN categoria c ON c.cat_cve=s.scat_cve_cat
AND c.cat_activo='A'
JOIN rubro r ON r.rb_cve=c.cat_cve_rb
AND r.rb_activo='A'
WHERE 1=1
AND p.pr_titulo LIKE concat('%', in_descripcion,'%') 
AND p.pr_activo='A'
ORDER BY p.pr_cve;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_li_pr_id` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_li_pr_id`( in_cve varchar(4))
BEGIN
SELECT * from producto PR join subcategoria SU on (PR.PR_SCAT_CVE = SU.SCAT_CVE) where PR_CVE=in_cve;

END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_li_pr_x_cve` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_li_pr_x_cve`(
in_cve varchar(4)
)
BEGIN
SELECT * FROM categoria CA join subcategoria SUB 
on(CA.CAT_CVE = SUB.SCAT_CVE_CAT) join producto PR 
on (SUB.SCAT_CVE = PR.PR_SCAT_CVE) where CA.CAT_CVE =in_cve ORDER BY PR.PR_CVE;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_li_rubros` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_li_rubros`(
)
BEGIN
SELECT *
    
FROM rubro 
  WHERE  (`RB_ACTIVO` =  'A');

END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_li_rubro_x_categoria` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_li_rubro_x_categoria`(
in_rubro varchar(3)
)
BEGIN

SELECT rubro.rb_cve, categoria.cat_titulo FROM categoria 
INNER JOIN rubro ON rubro.rb_cve=categoria.cat_cve_rb
AND  rubro.rb_cve=upper(in_rubro)
ORDER BY categoria.cat_cve;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_li_rubro_x_cve` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_li_rubro_x_cve`(
in_cve varchar(3)
)
BEGIN
SELECT RB_CVE, RB_TITULO, RB_DESCRIPCION 
	from rubro 
    where RB_CVE=in_cve;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_li_scat_x_cve` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_li_scat_x_cve`(
in_cve varchar(3)
)
BEGIN
SELECT SCAT_CVE, SCAT_TITULO, SCAT_DESCRIPCION 
	from subcategoria 
    where SCAT_CVE=in_cve;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_li_subcategoria` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_li_subcategoria`()
BEGIN
SELECT `SCAT_CVE`,
    `SCAT_TITULO`,
    `SCAT_DESCRIPCION`
    
FROM `indicadores`.`subcategoria`
  WHERE  (`SCAT_ACTIVO` =  'A');

END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_li_subcat_x_categoria` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_li_subcat_x_categoria`(
in_scat varchar(3)
)
BEGIN

SELECT s.scat_cve, c.cat_titulo FROM categoria c
INNER JOIN subcategoria s ON c.cat_cve=s.scat_cve_cat
AND  s.scat_cve=upper(in_scat)
ORDER BY c.cat_cve;

END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_pda_in_evaluar` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_pda_in_evaluar`( 
in_producto varchar(4),
in_doc_cve int,
periodo_cve varchar(10),
up_tiempo char(1),
up_forma char(1),
up_observaciones varchar(250),
up_activo char(1),
up_grado_cumplimiento int,
up_usuario_evaluador int,
up_ip varchar(15)
)
BEGIN

UPDATE `indicadores`.`evidencia_cumplimiento`
SET
`EC_PERIODO_CVE` = periodo_cve,
`EC_TIEMPO` = up_tiempo,
`EC_FORMA` = up_forma,
`EC_OBSERVACIONES` = up_observaciones,
`EC_ACTIVO` = up_activo,
`EC_GRADO_CUMPLIMIENTO` = up_grado_cumplimiento,
`EC_USUARIO_EVALUADOR` = up_usuario_evaluador,
`EC_FEC_UPDATE` = current_timestamp(),
`EC_LAST_IP` = inet_aton(up_ip)
WHERE `EC_DOCENTE_CVE` = in_doc_cve and  `EC_PR_CVE` = in_producto ;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_pda_in_productos_docente` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_pda_in_productos_docente`(
	in_cargaH varchar(10000), 
    in_docente int,
    in_num_productos int,
    in_periodo varchar(10),
    in_usuario int,
    in_ip varchar(15)
)
BEGIN 
		# Variables nesesarias para el funcionamiento del sistema
		DECLARE finished INTEGER DEFAULT 0;
		DECLARE f_pr_cve varchar(4) DEFAULT "";
		DECLARE num_productos INT DEFAULT 0; 
		DECLARE iteraciones INT DEFAULT 0; 
        DECLARE lim_superior INT DEFAULT 0;
        DECLARE lim_car_url INT DEFAULT 0;
        DECLARE lim_url INT DEFAULT 0;
        DECLARE productoyurl varchar(500) DEFAULT "";
		#se obtiene el numero de producto cargados y el nume maximo de caracteres
        SET num_productos = in_num_productos ;
		SET lim_superior =  (length(in_cargaH) + 1);
#ciclo que recorre por el numero de producto insertados
	WHILE iteraciones < num_productos DO 
        SET lim_car_url = substring(in_cargaH, 5, 1); 
        SET lim_url =  substring(in_cargaH, 6, lim_car_url); 
		SET productoyurl = substring(in_cargaH, 1, lim_url+7); 
		SET in_cargaH = substring(in_cargaH, 9 + lim_url , lim_superior-1); 
        
			BEGIN 
				#Separar las variables independientes de las varible que cotiene el producto con las horas de carga
				DECLARE in_producto varchar(4) DEFAULT substring(productoyurl, 1, 4);
                DECLARE URL varchar(250) default substring(productoyurl, 8, lim_url);
               # SELECT in_producto, URL;
                DEClARE cur_pr_x_entrega  
				CURSOR FOR 
				SELECT EC_PR_CVE FROM evidencia_cumplimiento EC 
                where EC_PR_CVE = in_producto and EC_DOCENTE_CVE = in_docente
                and EC_PERIODO_CVE = in_periodo ;
			DECLARE CONTINUE HANDLER 
				FOR NOT FOUND SET finished = 1;
		
			OPEN cur_pr_x_entrega; 

			carga_actividad: LOOP
				FETCH cur_pr_x_entrega INTO f_pr_cve;
				IF finished = 1 THEN 
					LEAVE carga_actividad;
				END IF;
				SELECT in_producto;
                UPDATE `indicadores`.`evidencia_cumplimiento`
				SET`EC_RUTA` = URL,
                `EC_FEC_UPDATE` = now(),
                `EC_FECHA_CUMPLIMIENTO` = now(),
                `EC_LAST_IP` = inet_aton(in_ip),
                `EC_BY_USER`= in_usuario
                WHERE `EC_PR_CVE` = f_pr_cve and `EC_DOCENTE_CVE` = in_docente ;
			END LOOP carga_actividad;
		CLOSE cur_pr_x_entrega;
			END;
	 SET finished = 0;
	 SET iteraciones = iteraciones+1;
	end while;
    
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_pda_li_producto_x_docente_sub` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_pda_li_producto_x_docente_sub`(
in_subcategoria varchar(3),
in_cve_docente int,
in_cve_periodo varchar(10)
)
BEGIN
select * from evidencia_cumplimiento EC join producto PR 
on EC.EC_PR_CVE = PR.PR_CVE 
where PR_SCAT_CVE = in_subcategoria and EC_PERIODO_CVE = in_cve_periodo
and EC_DOCENTE_CVE = in_cve_docente ;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_producto_x_titulo` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_producto_x_titulo`(
in_descripcion varchar(100)
)
BEGIN

SELECT r.rb_cve, 
r.rb_titulo, 
c.cat_cve, 
c.cat_titulo, 
s.scat_cve, 
s.scat_titulo, 
p.pr_cve, 
p.pr_titulo, 
p.pr_dias_entrega, 
p.pr_descripcion 
FROM producto p
JOIN subcategoria s ON s.scat_cve=p.pr_scat_cve 
AND s.scat_activo= 'A'
JOIN categoria c ON c.cat_cve=s.scat_cve_cat
AND c.cat_activo='A'
JOIN rubro r ON r.rb_cve=c.cat_cve_rb
AND r.rb_activo='A'
WHERE 1=1
AND p.pr_titulo LIKE concat('%', in_descripcion,'%') 
AND p.pr_activo='A'
ORDER BY p.pr_cve;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_rubro_x_categoria` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_rubro_x_categoria`(
in_rubro varchar(3)
)
BEGIN

SELECT rubro.rb_cve, categoria.cat_titulo FROM categoria 
INNER JOIN rubro ON rubro.rb_cve=categoria.cat_cve_rb
AND  rubro.rb_cve=upper(in_rubro)
ORDER BY categoria.cat_cve;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_subcat_x_categoria` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_subcat_x_categoria`(
in_scat varchar(3)
)
BEGIN

SELECT s.scat_cve, c.cat_titulo FROM categoria c
INNER JOIN subcategoria s ON c.cat_cve=s.scat_cve_cat
AND  s.scat_cve=upper(in_scat)
ORDER BY c.cat_cve;

END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_up_carga_evidencia_doc` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_up_carga_evidencia_doc`(
up_docente_cve int,
up_pr_cve varchar(4),
up_ruta_evidencia varchar(100)
)
BEGIN
UPDATE `indicadores`.`evidencia_cumplimiento`
SET
`EC_RUTA` = up_ruta_evidencia,
`EC_FEC_UPDATE` = current_timestamp()
WHERE `EC_DOCENTE_CVE` = up_docente_cve;

END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_up_categoria` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_up_categoria`(
up_cve varchar(4),
up_titulo varchar(160),
up_descripcion varchar(400),
up_activo char(1),
up_ip varchar(16),
up_user int
)
BEGIN
IF up_activo !='' THEN
UPDATE `indicadores`.`categoria`
SET
`CAT_ACTIVO` = 'I',
`CAT_FEC_UPDATE` = current_timestamp(),
`CAT_LAST_IP` = inet_aton(up_ip),
`CAT_BY_USER` = up_user
WHERE `CAT_CVE` = up_cve;
ELSE
	UPDATE `indicadores`.`categoria`
	SET
		`CAT_TITULO` =up_titulo,
		`CAT_DESCRIPCION` = up_descripcion,
		`CAT_FEC_UPDATE` = current_timestamp(),
		`CAT_LAST_IP` = inet_aton(up_ip),
		`CAT_BY_USER` = up_user
	WHERE `CAT_CVE` = up_cve;
END IF;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_up_docente` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_up_docente`(
up_cve int,
up_nombre varchar(100),
up_grado varchar (50),
up_cedula int,
up_estudios varchar(100),
up_experiencia double,
up_docencia double,
up_categoria varchar(50),
up_num_empleado int,
up_contraseña varchar(32)
)
BEGIN
UPDATE `indicadores`.`docente`
SET
`DO_CVE_DOCENTE` = up_cve,
`DO_NOMBRE` = up_nombre,
`DO_GRADO` = up_grado,
`DO_CEDULA` = up_cedula,
`DO_ESTUDIOS` = up_estudios,
`DO_EXPERIENCIA` = up_experiencia,
`DO_DOCENCIA` = up_docencia,
`DO_CATEGORIA` = up_categoria,
`DO_NUM_EMPLEADO` = up_num_empleado,
`DO_CONTRASENA` = up_contraseña
WHERE `DO_CVE_DOCENTE` = up_cve;

END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_up_fecha_pr` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_up_fecha_pr`(
up_pr_cve varchar(4),
up_fecha_programada datetime
)
BEGIN
UPDATE `indicadores`.`evidencia_cumplimiento`
SET

`EC_FECHA_PROGRAMADA` = up_fecha_programada,
`EC_FECHA_CUMPLIMIENTO`= DATE_ADD(up_fecha_programada, INTERVAL 10 DAY)
WHERE `EC_PR_CVE` = up_pr_cve;

END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_up_periodo` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_up_periodo`(
up_pe_cve varchar(10),
up_fecha_inicio date,
up_fecha_fin date,
up_anio varchar(4),
up_descripcion varchar(50),
up_fec_update datetime,
up_activo char(1),
up_ip varchar(15),
up_user int
)
BEGIN
UPDATE `indicadores`.`periodo`
SET
`PE_CVE` = up_pe_cve,
`PE_FECHA_INICIO` = up_fecha_inicio,
`PE_FECHA_FIN` = up_fecha_fin,
`PE_ANIO` = up_anio,
`PE_DESCRIPCION` = up_descripcion,
`PE_LAST_UPDATE` = current_timestamp(),
`PE_ACTIVO` = up_activo,
`PE_LAST_IP` = inet_aton(up_ip),
`PE_BY_USER` = up_user
WHERE `PE_CVE` = up_pe_cve;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_up_producto` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_up_producto`(
up_cve varchar(4),
up_titulo varchar(150),
up_descripcion varchar(100),
up_activo char(1),
up_ip varchar(15),
up_user int
)
BEGIN
IF up_activo !='' THEN
	UPDATE `indicadores`.`producto`
	SET
		`PR_ACTIVO` = 'I',
		`PR_FEC_UPDATE` = current_timestamp(),
		`PR_LAST_IP` = inet_aton(up_ip),
		`PR_BY_USER` = up_user
	WHERE `PR_CVE` = up_cve;
    
ELSE 
	
	UPDATE `indicadores`.`producto`
	SET
		`PR_TITULO` =up_titulo,
		`PR_DESCRIPCION` = up_descripcion,
		`PR_FEC_UPDATE` = current_timestamp(),
		`PR_LAST_IP` = inet_aton(up_ip),
		`PR_BY_USER` = up_user
	WHERE `PR_CVE` = up_cve;
END IF;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_up_rubro` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_up_rubro`(
up_cve varchar(3),
up_titulo varchar(50),
up_descripcion varchar(150),
up_activo char(1),
up_ip varchar(15),
up_user int
)
BEGIN
#procedimiento almacenado que permite que un Rubro o categoria pueda ser actulizado por el admin
#desicion que permite validar la entrada de datos que en caso que la variable
#up_activo sea diferente de de cadena vacia entrara en el primer ciclo y desabilidara el rubro
IF up_activo !='' THEN
	# se actuliza con la sentencia update a la base de datos indicadores en la tabla rubro
	UPDATE `indicadores`.`rubro`
	SET
		`RB_ACTIVO` = 'I',
		`RB_FEC_UPDATE` = current_timestamp(),
		`RB_LAST_IP` = inet_aton(up_ip),
		`RB_BY_USER` = up_user
	WHERE `RB_CVE` = up_cve;
    
ELSE 
	#En caso que el atributo up_activo sea igual a cadena vacia 
    #sera posible actulizar el rubro de manera correcta y se insertan los valores que se enviaron desde php
	UPDATE `indicadores`.`rubro`
	SET
		`RB_TITULO` =up_titulo,
		`RB_DESCRIPCION` = up_descripcion,
		`RB_FEC_UPDATE` = current_timestamp(),
		`RB_LAST_IP` = inet_aton(up_ip),
		`RB_BY_USER` = up_user
	WHERE `RB_CVE` = up_cve;
END IF;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_up_subcategoria` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_up_subcategoria`(

up_cve varchar(3),
up_titulo varchar(100),
up_descripcion varchar(100),
up_activo char(1),
up_ip varchar(15),
up_user int
)
BEGIN
IF up_activo !='' THEN
	UPDATE `indicadores`.`subcategoria`
	SET
		`SCAT_ACTIVO` = 'I',
		`SCAT_FEC_UPDATE` = current_timestamp(),
		`SCAT_LAST_IP` = inet_aton(up_ip),
		`SCAT_BY_USER` = up_user
	WHERE `SCAT_CVE` = up_cve;
    
ELSE 
	
	UPDATE `indicadores`.`subcategoria`
	SET
		`SCAT_TITULO` =up_titulo,
		`SCAT_DESCRIPCION` = up_descripcion,
		`SCAT_FEC_UPDATE` = current_timestamp(),
		`SCAT_LAST_IP` = inet_aton(up_ip),
		`SCAT_BY_USER` = up_user
	WHERE `SCAT_CVE` = up_cve;
END IF;
END ;;
DELIMITER ;

/*!50003 DROP PROCEDURE IF EXISTS `sp_validar_usuario` */;

DELIMITER ;;
CREATE DEFINER=`pda`@`%` PROCEDURE `sp_validar_usuario`(in_nombre varchar(50), in_contraseña text )
BEGIN
	declare rol int;
    declare periodo varchar(5);
	set rol = (select US.US_R_ROL from usuario US where US.US_NOMBRE = in_nombre and US.US_PASSWORD = in_contraseña);
	set periodo = (select PR.PE_CVE from periodo PR where PR.PE_ACTIVO ="A" );
IF rol = 1 THEN 
    select *,periodo as PE_ACTIVO from usuario US where US.US_NOMBRE = in_nombre and US.US_PASSWORD = in_contraseña;
END IF;
IF rol = 2 THEN
    select *,periodo as PE_ACTIVO  from usuario US join docente DOC on(US.US_ID = DOC.DO_US_ID ) where US.US_NOMBRE = in_nombre and US.US_PASSWORD = in_contraseña;
END IF;

END ;;
DELIMITER ;


UPDATE `indicadores`.`usuario` SET `US_PASSWORD` = md5('123456789') WHERE (`US_ID` = '32');
UPDATE `indicadores`.`usuario` SET `US_PASSWORD` = md5('123456789') WHERE (`US_ID` = '33');
UPDATE `indicadores`.`usuario` SET `US_PASSWORD` = md5('123456789') WHERE (`US_ID` = '34');
UPDATE `indicadores`.`usuario` SET `US_PASSWORD` = md5('123456789') WHERE (`US_ID` = '35');
UPDATE `indicadores`.`usuario` SET `US_PASSWORD` = md5('123456789') WHERE (`US_ID` = '36');
UPDATE `indicadores`.`usuario` SET `US_PASSWORD` = md5('123456789') WHERE (`US_ID` = '37');
UPDATE `indicadores`.`usuario` SET `US_PASSWORD` = md5('123456789') WHERE (`US_ID` = '38');
UPDATE `indicadores`.`usuario` SET `US_PASSWORD` = md5('123456789') WHERE (`US_ID` = '39');
UPDATE `indicadores`.`usuario` SET `US_PASSWORD` = md5('123456789') WHERE (`US_ID` = '40');
UPDATE `indicadores`.`usuario` SET `US_PASSWORD` = md5('123456789') WHERE (`US_ID` = '41');
UPDATE `indicadores`.`usuario` SET `US_PASSWORD` = md5('123456789') WHERE (`US_ID` = '42');
UPDATE `indicadores`.`usuario` SET `US_PASSWORD` = md5('123456789') WHERE (`US_ID` = '43');
UPDATE `indicadores`.`usuario` SET `US_PASSWORD` = md5('123456789') WHERE (`US_ID` = '44');
UPDATE `indicadores`.`usuario` SET `US_PASSWORD` = md5('123456789') WHERE (`US_ID` = '45');
UPDATE `indicadores`.`usuario` SET `US_PASSWORD` = md5('123456789') WHERE (`US_ID` = '46');
UPDATE `indicadores`.`usuario` SET `US_PASSWORD` = md5('123456789') WHERE (`US_ID` = '47');
UPDATE `indicadores`.`usuario` SET `US_PASSWORD` = md5('123456789') WHERE (`US_ID` = '48');
UPDATE `indicadores`.`usuario` SET `US_PASSWORD` = md5('123456789') WHERE (`US_ID` = '49');




--
-- Dumping routines for database 'indicadores'
--
/*!50003 DROP PROCEDURE IF EXISTS `so_up_fecha_doc` */;
