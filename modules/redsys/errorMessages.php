<?php
/**
 * 2011-2014 OBSolutions S.C.P. All Rights Reserved.
 *
 * NOTICE:  All information contained herein is, and remains
 * the property of OBSolutions S.C.P. and its suppliers,
 * if any.  The intellectual and technical concepts contained
 * herein are proprietary to OBSolutions S.C.P.
 * and its suppliers and are protected by trade secret or copyright law.
 * Dissemination of this information or reproduction of this material
 * is strictly forbidden unless prior written permission is obtained
 * from OBSolutions S.C.P.
 *
 *  @author    OBSolutions SCP <http://addons.prestashop.com/en/65_obs-solutions>
 *  @copyright 2011-2014 OBSolutions SCP
 *  @license   OBSolutions S.C.P. All Rights Reserved
 *  International Registered Trademark & Property of OBSolutions SCP
 */

$errorMessages = array(
	'101' => 'Tarjeta caducada.',
	'102' => 'Tarjeta en excepción transitoria o bajo sospecha de fraude.',
	'104' => 'Operación no permitida para esa tarjeta o terminal.',
	'106' => 'Número de intentos excedido.',
	'107' => 'El banco emisor no permite una autorización automática',
	'109' => 'Denegada porque el comercio no está correctamente dado de alta en los sistemas internacionales de tarjetas.',
	'110' => 'El importe de la transacción es inusual para el tipo de comercio que solicita la autorización de pago.',
	'114' => 'Operación no permitida para ese tipo de tarjeta.',
	'116' => 'Disponible insuficiente.',
	'118' => 'Tarjeta no registrada.',
	'125' => 'Tarjeta inexistente o no dada de alta',
	'129' => 'Código de seguridad (CVV2/CVC2) incorrecto.',
	'167' => 'Contactar con el emisor: sospecha de frause',
	'180' => 'Tarjeta ajena al servicio.',
	'181' => 'Tarjeta bloqueada transitoriamente por el banco emisor',
	'182' => 'Tarjeta bloqueada transitoriamente por el banco emisor',
	'184' => 'Error en la autenticación del titular.',
	'190' => 'Denegación sin especificar motivo.',
	'191' => 'Fecha de caducidad errónea.',
	'202' => 'Tarjeta en excepción transitoria o bajo sospecha de fraude con retirada de tarjeta.',
	'207' => 'El banco emisor no permite una autorización automáitca',
	'208' => 'Tarjeta perdida o robada',
	'209' => 'Tarjeta perdida o robada',
	'280' => 'Código de seguridad (CVV2/CVC2) incorrecto.',
	'290' => 'Denegación sin especificar motivo.',
	'400' => 'Anulación aceptada',
	'480' => 'No se encuentra la operación original o timeout excedido',
	'481' => 'Anulación aceptada',
	'900' => 'Transacción autorizada para devoluciones y confirmaciones.',
	'912' => 'Emisor no disponible.',
	'SIS0007' => 'Error al desmontar XML de entrada',
	'SIS0008' => 'Ds_Merchant_MerchantCode Falta el campo',
	'SIS0009' => 'Ds_Merchant_MerchantCode Error de formato',
	'SIS0010' => 'Ds_Merchant_Terminal Falta el campo',
	'SIS0011' => 'Ds_Merchant_Terminal Error de formato',
	'SIS0014' => 'Ds_Merchant_Order Error de formato',
	'SIS0015' => 'Ds_Merchant_Currency Falta el campo',
	'SIS0016' => 'Ds_Merchant_Currency Error de formato',
	'SIS0018' => 'Ds_Merchant_Amount Falta el campo',
	'SIS0019' => 'Ds_Merchant_Amount Error de formato',
	'SIS0020' => 'Ds_Merchant_Signature Falta el campo',
	'SIS0021' => 'Ds_Merchant_Signature Campo sin datos',
	'SIS0022' => 'Ds_TransactionType Error de formato',
	'SIS0023' => 'Ds_TransactionType Valor desconocido',
	'SIS0024' => 'Ds_ConsumerLanguage Valor excede de 3 posiciones',
	'SIS0025' => 'Ds_ConsumerLanguage Error de formato',
	'SIS0026' => 'Ds_Merchant_MerchantCode Error No existe el comercio / Terminal enviado',
	'SIS0027' => 'Ds_Merchant_Currency Error moneda no coincide con asignada para ese Terminal.',
	'SIS0028' => 'Ds_Merchant_MerchantCode Error Comercio/Terminal está dado de baja',
	'SIS0030' => 'Ds_TransactionType En un pago con tarjeta ha llegado un tipo de operación que no es ni pago ni preautoritzación',
	'SIS0031' => 'Ds_Merchant_TransactionType Método de pago no definido',
	'SIS0034' => 'Error en acceso a la Base de datos',
	'SIS0038' => 'Error en JAVA',
	'SIS0040' => 'El comercio / Terminal no tiene ningún método de pago asignado',
	'SIS0041' => 'Ds_Merchant_Signature Error en el cálculo del algoritmo HASH',
	'SIS0042' => 'Ds_Merchant_Signature Error en el cálculo del algoritmo HASH',
	'SIS0043' => 'Error al realizar la notificación online',
	'SIS0046' => 'El BIN (6 primeros dígitos de la tarjeta) no está dado de alta',
	'SIS0051' => 'Ds_Merchant_Order Número de pedido repetido',
	'SIS0054' => 'Ds_Merchant_Order No existe operación sobre la que realizar la devolución',
	'SIS0055' => 'Ds_Merchant_Order La operación sobre la que se desea realizar la devolución no es una operación válida',
	'SIS0056' => 'Ds_Merchant_Order La operación sobre la que se desea realizar la devolución no está autorizada',
	'SIS0057' => 'Ds_Merchant_Amount El importe a devolver supera el permitido',
	'SIS0058' => 'Inconsistencia de datos, en la validación de una confirmación',
	'SIS0059' => 'Ds_Merchant_Order Error, no existe la operación sobre la que realizar la confirmación',
	'SIS0060' => 'Ds_Merchant_Order Ya existe confirmación asociada a la preautorización',
	'SIS0061' => 'Ds_Merchant_Order La preautorización sobre la que se desea confirmar no está autorizada',
	'SIS0062' => 'Ds_Merchant_Amount El importe a confirmar supera el permitido',
	'SIS0063' => 'Error en número de tarjeta',
	'SIS0064' => 'Error en número de tarjeta',
	'SIS0065' => 'Error en número de tarjeta',
	'SIS0066' => 'Error en caducidad tarjeta',
	'SIS0067' => 'Error en caducidad tarjeta',
	'SIS0068' => 'Error en caducidad tarjeta',
	'SIS0069' => 'Error en caducidad tarjeta',
	'SIS0070' => 'Error en caducidad tarjeta',
	'SIS0071' => 'Tarjeta caducada',
	'SIS0072' => 'Ds_Merchant_Order Operación no anulable',
	'SIS0074' => 'Ds_Merchant_Order Falta el campo',
	'SIS0075' => 'Ds_Merchant_Order El valor tiene menos de 4 posiciones o más de 12',
	'SIS0076' => 'Ds_Merchant_Order El valor no es numérico',
	'SIS0078' => 'Ds_TransactionType Valor desconocido',
	'SIS0093' => 'Tarjeta no encontrada en tabla de rangos',
	'SIS0094' => 'La tarjeta no fue autenticada como 3D Secure',
	'SIS0112' => 'Ds_TransactionType Valor no permitido',
	'SIS0114' => 'Se ha llamado con un GET en lugar de un POST',
	'SIS0115' => 'Ds_Merchant_Order No existe operación sobre la que realizar el pago de la cuota',
	'SIS0116' => 'Ds_Merchant_Order La operación sobre la que se desea pagar una cuota no es válida.',
	'SIS0117' => 'Ds_Merchant_Order La operación sobre la que se desea pagar una cuota no está autorizada',
	'SIS0132' => 'La fecha de Confirmación de Autorización no puede superar en más de 7 días a la preautorización',
	'SIS0133' => 'La fecha de confirmación de Autenticación no puede superar en más de 45 días la autenticación previa',
	'SIS0139' => 'El pago recurrente inicial está duplicado',
	'SIS0142' => 'Tiempo excedido para el pago',
	'SIS0198' => 'Importe supera límite permitido para el comercio',
	'SIS0199' => 'El número de operaciones supera el límite permitido para el comercio',
	'SIS0200' => 'El importe acumulado supera el límite permitido para el comercio',
	'SIS0214' => 'El comercio no admite devoluciones',
	'SIS0216' => 'El CVV2 tiene más de tres posiciones',
	'SIS0217' => 'Error de formato en CVV2',
	'SIS0218' => 'La entrada “Operaciones” no permite pagos seguros',
	'SIS0219' => 'El número de operaciones de la tarjeta supera el límite permitido para el comercio',
	'SIS0220' => 'El importe acumulado de la tarjeta supera el límite permitido para el comercio',
	'SIS0221' => 'Error. El CVV2 es obligatorio',
	'SIS0222' => 'Ya existe anulación asociada a la preautorización',
	'SIS0223' => 'La preautorización que se desea anular no está autorizada',
	'SIS0224' => 'El comercio no permite anulaciones por no tener firma ampliada',
	'SIS0225' => 'No existe operación sobre la que realizar la anulación',
	'SIS0226' => 'Inconsistencia de datos en la validación de una anulación',
	'SIS0227' => 'Ds_Merchant_TransactionDate Valor no válido',
	'SIS0229' => 'No existe el código de pago aplazado solicitado',
	'SIS0252' => 'El comercio no permite el envío de tarjeta',
	'SIS0253' => 'La tarjeta no cumple el check-digit',
	'SIS0254' => 'El número de operaciones por IP supera el máximo permitido para el comercio',
	'SIS0255' => 'El importe acumulado por IP supera el límite permitido para el comercio',
	'SIS0256' => 'El comercio no puede realizar preautorizaciones',
	'SIS0257' => 'La tarjeta no permite preautorizaciones',
	'SIS0258' => 'Inconsistencia en datos de confirmación',
	'SIS0261' => 'Operación supera alguna limitación de operatoria definida por Banco Sabadell',
	'SIS0270' => 'Ds_Merchant_TransactionType Tipo de operación no activado para este comercio',
	'SIS0274' => 'Ds_Merchant_TransactionType Tipo de operación desconocida o no permitida para esta entrada al TPV Virtual.',
	'SIS0281' => 'Operación supera alguna limitación de operatoria definida por Banco Sabadell.',
	'SIS0296' => 'Error al validar los datos de la operación “Tarjeta en Archivo (P.Suscripciones/P.Exprés)” inicial.',
	'SIS0297' => 'Superado el número máximo de operaciones (99 oper. o 1 año) para realizar transacciones sucesivas de “Tarjeta en Archivo (P.Suscripciones/P.Exprés)”. Se requiere realizar una nueva operación de “Tarjeta en Archivo Inicial” para iniciar el ciclo..',
	'SIS0298' => 'El comercio no está configurado para realizar “Tarjeta en Archivo (P.Suscripciones/P.Exprés)”',
);