function encabezado(now, personal) {
    return {
        margin: [20, 10, 20, 0],
        columns: [
            {
                image: hospitalIconBase64, // Agrega el ícono como una imagen base64
                width: 100,
                height: 60
            },
            {
                alignment: 'center',
                stack: [
                    {
                        text: 'Hospital Regional Laredo',
                        fontSize: 16,
                        bold: true,
                        margin: [0, 10, 0, 0],
                        color: '#007c7a'
                    },
                    {
                        text: 'Dirección: Antenor Orrego, Laredo 13101',
                        fontSize: 10,
                        margin: [0, 0, 0, 0]
                    }
                ],
                width: '*'
            },
            {
                alignment: 'right',
                stack: [
                    {
                        text: 'Fecha de emisión:\n' + now,
                        fontSize: 10,
                        margin: [0, 10, 0, 0]
                    },
                    {
                        text: 'Encargado(a):\n' + personal.Nombres + ' ' + personal.Apellidos,
                        fontSize: 10,
                        margin: [0, 10, 0, 0]
                    }
                ],
                width: 'auto'
            }
        ]
    };
}

function pieDePagina() {
    return function (currentPage, pageCount) {
        return {
            columns: [
                {
                    alignment: 'right',
                    text: [
                        { text: 'Página ' + currentPage.toString() + ' de ' + pageCount.toString(), fontSize: 10 }
                    ]
                }
            ],
            margin: [10, 10]
        };
    };
}

function informacionPersonas(personal) {
    return [
        {
            text: 'Información de Personas',
            fontSize: 15,
            bold: true,
            margin: [0, 10, 0, 5],
        },
        {
            columns: [
                {
                    stack: [
                        {
                            text: 'Encargado(a)',
                            fontSize: 10,
                            bold: true,
                            alignment: 'center',
                            margin: [0, 0, 0, 2]
                        },
                        {
                            text: 'DNI: ' + personal.Dni,
                            fontSize: 10,
                            margin: [0, 0, 0, 2]
                        },
                        {
                            text: 'Nombres y Apellidos: ' + personal.Nombres + ' ' + personal.Apellidos,
                            fontSize: 10,
                            margin: [0, 0, 0, 2]
                        },
                        {
                            text: 'Cargo: ' + personal.servicio.Descripcion,
                            fontSize: 10,
                            margin: [0, 0, 0, 2]
                        },
                        {
                            text: 'Contacto: ' + personal.Celular,
                            fontSize: 10,
                            margin: [0, 0, 0, 5]
                        }
                    ]
                },
                {
                    stack: [
                        {
                            text: 'Solicitante',
                            fontSize: 10,
                            bold: true,
                            alignment: 'center',
                            margin: [0, 0, 0, 2]
                        },
                        {
                            text: 'DNI: _______________________________________________________',
                            fontSize: 10,
                            margin: [0, 0, 0, 2]
                        },
                        {
                            text: 'Nombres y Apellidos: ______________________________________',
                            fontSize: 10,
                            margin: [0, 0, 0, 2]
                        },
                        {
                            text: 'Cargo: _____________________________________________________',
                            fontSize: 10,
                            margin: [0, 0, 0, 2]
                        },
                        {
                            text: 'Contacto: __________________________________________________',
                            fontSize: 10,
                            margin: [0, 0, 0, 5]
                        }
                    ]
                }
            ],
            columnGap: 10
        }
    ];
}

function firmasPersonas() {
    return [
        {
            text: '',
            margin: [0, 20, 0, 20]
        },
        {
            columns: [
                {
                    width: '50%',
                    text: '_________________________\nFirma del Encargado',
                    alignment: 'center',
                    margin: [0, 20, 0, 0]
                },
                {
                    width: '50%',
                    text: '_________________________\nFirma del Solicitante',
                    alignment: 'center',
                    margin: [0, 20, 0, 0]
                }
            ],
            columnGap: 20
        }
    ];
}

function pdfReporteIngreso(doc, detalle) {
    // Capturar la fecha y hora actuales
    var now = moment().format('YYYY-MM-DD HH:mm:ss');
    var personal = JSON.parse(localStorage.getItem('personal'));

    // Configuración general del PDF
    var margenHeader = 60;
    var margenFooter = 60;
    doc.pageMargins = [20, margenHeader + 20, 20, margenFooter]; // Ajusta los márgenes de la página - margen: [izquierda, arriba, derecha, abajo]
    doc.pageSize = 'A4'; // Tamaño de la página
    doc.pageOrientation = 'portrait'; // or 'landscape' para horizontal
    doc.info = {
        title: 'Reporte_Ingresos.pdf',
    };

    // Agregar encabezado, pie de página e información de personas
    doc['header'] = encabezado(now, personal);
    doc['footer'] = pieDePagina();
    // Agregar información específica de ingreso si está disponible
    if (detalle) {
        var ingreso = JSON.parse(localStorage.getItem('ingreso'));
        doc.content.unshift(
            {
                text: 'Información Ingreso',
                fontSize: 15,
                bold: true,
                margin: [0, 10, 0, 2]
            },
            {
                columns: [
                    {
                        stack: [
                            {
                                text: 'Código Interno: ' + ingreso.NumeroInterno,
                                fontSize: 10,
                                margin: [0, 0, 0, 2]
                            },
                            {
                                text: 'Código de Documento: ' + ingreso.NumeroPecosa,
                                fontSize: 10,
                                margin: [0, 0, 0, 2]
                            },
                            {
                                text: 'Fecha ingreso: ' + ingreso.Fecha,
                                fontSize: 10,
                                margin: [0, 0, 0, 2]
                            }
                        ]
                    },
                    {
                        stack: [
                            {
                                text: 'Origen: ' + (ingreso.IdOrigen == 4 ? ingreso.OtroOrigen : ingreso.IdOrigen),
                                fontSize: 10,
                                margin: [0, 0, 0, 5]
                            },
                            {
                                text: 'Personal: ' + ingreso.IdPersonal,
                                fontSize: 10,
                                margin: [0, 0, 0, 2]
                            },
                            {
                                text: 'Comentario: ' + ingreso.Observacion,
                                fontSize: 10,
                                margin: [0, 0, 0, 2]
                            }
                        ]
                    }
                ],
                columnGap: 10
            }
        );
    }
    doc.content.unshift(...informacionPersonas(personal));// doc representa el documento PDF, content es una matriz que contiene todos los elementos del cuerpo

    // Agregar espacio para firmas
    doc.content.push(...firmasPersonas());
}

function pdfReporteBaja(doc, detalle) {
    // Capturar la fecha y hora actuales
    var now = moment().format('YYYY-MM-DD HH:mm:ss');
    var personal = JSON.parse(localStorage.getItem('personal'));

    // Configuración general del PDF
    var margenHeader = 60;
    var margenFooter = 60;
    doc.pageMargins = [20, margenHeader + 20, 20, margenFooter];
    doc.pageSize = 'A4';
    doc.pageOrientation = 'portrait';
    doc.info = {
        title: 'Reporte_Bajas.pdf',
    };

    // Agregar encabezado, pie de página e información de personas
    doc['header'] = encabezado(now, personal);
    doc['footer'] = pieDePagina();
    
    // Agregar información específica de baja si está disponible
    if (detalle) {
        var baja = JSON.parse(localStorage.getItem('baja'));
        doc.content.unshift(
            {
                text: 'Información Baja',
                fontSize: 15,
                bold: true,
                margin: [0, 10, 0, 2]
            },
            {
                columns: [
                    {
                        stack: [
                            {
                                text: 'Código de Baja: ' + baja.CodigoBaja,
                                fontSize: 10,
                                margin: [0, 0, 0, 2]
                            },
                            {
                                text: 'Fecha baja: ' + baja.Fecha,
                                fontSize: 10,
                                margin: [0, 0, 0, 2]
                            }
                        ]
                    },
                    {
                        stack: [
                            {
                                text: 'Personal: ' + baja.Personal,
                                fontSize: 10,
                                margin: [0, 0, 0, 2]
                            },
                            {
                                text: 'Comentario: ' + baja.Observacion,
                                fontSize: 10,
                                margin: [0, 0, 0, 2]
                            }
                        ]
                    }
                ],
                columnGap: 10
            }
        );
    }
    doc.content.unshift(...informacionPersonas(personal));

    // Agregar espacio para firmas
    doc.content.push(...firmasPersonas());
}

function pdfReportePatrimonio(doc, detalle) {
    // Capturar la fecha y hora actuales
    var now = moment().format('YYYY-MM-DD HH:mm:ss');
    var personal = JSON.parse(localStorage.getItem('personal'));

    // Configuración general del PDF
    var margenHeader = 60;
    var margenFooter = 60;
    doc.pageMargins = [20, margenHeader + 20, 20, margenFooter];
    doc.pageSize = 'A4';
    doc.pageOrientation = 'landscape';
    doc.info = {
        title: 'Reporte_Patrimonio.pdf',
    };

    // Agregar encabezado, pie de página e información de personas
    doc['header'] = encabezado(now, personal);
    doc['footer'] = pieDePagina();
    
    // Agregar información específica de baja si está disponible
    if (detalle) {
        var patrimonio = JSON.parse(localStorage.getItem('patrimonio'));
        doc.content.unshift(
            {
                text: 'Información Patrimonio',
                fontSize: 15,
                bold: true,
                margin: [0, 10, 0, 2]
            },
            {
                columns: [
                    {
                        stack: [
                            {
                                text: 'Código de Baja: ' + patrimonio.CodigoBaja,
                                fontSize: 10,
                                margin: [0, 0, 0, 2]
                            },
                            {
                                text: 'Fecha baja: ' + patrimonio.Fecha,
                                fontSize: 10,
                                margin: [0, 0, 0, 2]
                            }
                        ]
                    },
                    {
                        stack: [
                            {
                                text: 'Personal: ' + patrimonio.Personal,
                                fontSize: 10,
                                margin: [0, 0, 0, 2]
                            },
                            {
                                text: 'Comentario: ' + patrimonio.Observacion,
                                fontSize: 10,
                                margin: [0, 0, 0, 2]
                            }
                        ]
                    }
                ],
                columnGap: 10
            }
        );
    }
    doc.content.unshift(...informacionPersonas(personal));

    // Agregar espacio para firmas
    doc.content.push(...firmasPersonas());
}

function excelEditado(xlsx) {
    // Personaliza el archivo Excel aquí si es necesario
}