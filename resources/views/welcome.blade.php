<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Origin Verification</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <!-- Modern Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <style>
        /* Print Styles */
        @media print {
            @page {
                size: A4 portrait;
                margin: 8mm 10mm;
            }
            html, body {
                background: white !important;
                color: #000 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            /* Hide background image and overlay */
            body::before,
            body::after {
                display: none !important;
                content: none !important;
            }
            /* Hide scrollbar tracks */
            .accordion::-webkit-scrollbar {
                display: none !important;
            }
            .background-overlay,
            .card-actions,
            .table-pagination {
                display: none !important;
            }
            .container {
                max-width: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
            }
            .verification-card {
                box-shadow: none !important;
                border: none !important;
                background: white !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .card-title {
                font-size: 13px !important;
                margin-bottom: 6px !important;
                text-align: center;
            }
            /* Force expand all accordions */
            .accordion-content {
                display: block !important;
                max-height: none !important;
                overflow: visible !important;
                visibility: visible !important;
                opacity: 1 !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .accordion {
                gap: 0 !important;
            }
            .accordion-item {
                page-break-inside: avoid;
                border-top: 1px solid #ddd !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            .accordion-header {
                pointer-events: none !important;
                min-height: auto !important;
                padding: 3px 0 !important;
                background: transparent !important;
                border: none !important;
            }
            .accordion-header .icon {
                display: none !important;
            }
            .accordion-header .title {
                color: #000 !important;
                font-weight: 700 !important;
                font-size: 9px !important;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }
            .accordion-header .line {
                display: none !important;
            }
            .content-inner {
                padding: 2px 0 4px !important;
            }
            .data-grid {
                display: grid !important;
                grid-template-columns: 1fr 1fr !important;
                gap: 1px 10px !important;
            }
            .data-field {
                margin: 1px 0 !important;
                padding: 0 !important;
            }
            .data-field.full-width {
                grid-column: span 2 !important;
            }
            .data-label {
                font-size: 8px !important;
                color: #555 !important;
                font-weight: 600 !important;
            }
            .data-value {
                font-size: 8px !important;
                color: #000 !important;
            }
            /* Tables */
            .custom-table-container {
                margin: 2px 0 !important;
                box-shadow: none !important;
                border: 1px solid #ccc !important;
                overflow: hidden !important;
            }
            .table-responsive {
                overflow-x: visible !important;
                overflow: visible !important;
                width: 100% !important;
            }
            .custom-table {
                width: 100% !important;
                table-layout: fixed !important;
                white-space: normal !important;
                word-break: break-word !important;
                font-size: 7px !important;
            }
            .table-header-title {
                font-size: 8px !important;
                padding: 2px 4px !important;
            }
            .custom-table th {
                font-size: 7px !important;
                padding: 2px 3px !important;
                white-space: normal !important;
                word-break: break-word !important;
                line-height: 1.2 !important;
            }
            .custom-table td {
                font-size: 7.5px !important;
                padding: 2px 3px !important;
                white-space: normal !important;
                word-break: break-word !important;
            }
            /* Transport label */
            .data-field[style] {
                margin-bottom: 2px !important;
            }
        }

        /* Modal Styles */
        .pdf-modal-backdrop {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(8px);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }
        .pdf-modal-backdrop.active {
            opacity: 1;
            pointer-events: auto;
        }
        .pdf-modal-container {
            background: white;
            width: 90%;
            height: 90%;
            max-width: 1200px;
            border-radius: 16px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transform: scale(0.95);
            transition: transform 0.3s ease;
        }
        .pdf-modal-backdrop.active .pdf-modal-container {
            transform: scale(1);
        }
        .pdf-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 24px;
            border-bottom: 1px solid #e2e8f0;
            background: #f8fafc;
        }
        .pdf-modal-title {
            font-weight: 600;
            color: #0f172a;
            font-size: 1.1rem;
        }
        .pdf-modal-close {
            background: none;
            border: none;
            color: #64748b;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .pdf-modal-close:hover {
            background: #e2e8f0;
            color: #0f172a;
        }
        .pdf-modal-body {
            flex: 1;
            width: 100%;
            height: 100%;
        }
        .pdf-modal-body iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>
    <div class="background-overlay"></div>
    
    <main class="container">
        <div class="verification-card">
            <h1 class="card-title">I.R. Of IRAN Certificate Of Origin Verification</h1>
            
            <div class="accordion">
                <!-- General -->
                <div class="accordion-item">
                    <button class="accordion-header" aria-expanded="true">
                        <svg class="icon" viewBox="0 0 24 24" width="16" height="16">
                            <path fill="currentColor" d="M8 5v14l11-7z"/>
                        </svg>
                        <span class="title">General</span>
                        <div class="line"></div>
                    </button>
                    <div class="accordion-content">
                        <div class="content-inner">
                            <div class="data-grid">
                                <div class="data-field inline">
                                    <span class="data-label">CO Type :</span>
                                    <span class="data-value">GSTP</span>
                                </div>
                                <div class="data-field inline">
                                    <span class="data-label">Issue Date :</span>
                                    <span class="data-value">{{ $shipment->date ?? '2026-07-19' }}</span>
                                </div>
                                
                                <div class="data-field inline">
                                    <span class="data-label">Reference Number :</span>
                                    <span class="data-value">{{ $shipment->serial_no ?? '1502606160012' }}</span>
                                </div>
                                <div class="data-field">
                                    <span class="data-label">QR-Code :</span>
                                    <span class="data-value">{{ $shipment->qr_code ?? 'efbb9c07238f4ba48e8a6f20ba752741' }}</span>
                                </div>
                                
                                <div class="data-field">
                                    <span class="data-label">Certifying Organization :</span>
                                    <span class="data-value">Urmia Chamber of Commerce, Industries, Mines<br>& Agriculture</span>
                                </div>
                                <div class="data-field">
                                    <span class="data-label">Authority Branch :</span>
                                    <span class="data-value">Urmia Chamber of Commerce, Industries, Mi<br>& Agriculture</span>
                                </div>
                                
                                <div class="data-field full-width">
                                    <span class="data-label">Authenticator Name and Position :</span>
                                    <span class="data-value">Mr .GHASEM KARIMI president of Urmia CCIMA</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Exporter -->
                <div class="accordion-item">
                    <button class="accordion-header" aria-expanded="true">
                        <svg class="icon" viewBox="0 0 24 24" width="16" height="16">
                            <path fill="currentColor" d="M8 5v14l11-7z"/>
                        </svg>
                        <span class="title">Exporter</span>
                        <div class="line"></div>
                    </button>
                    <div class="accordion-content">
                        <div class="content-inner">
                            <div class="data-grid">
                                <div class="data-field inline">
                                    <span class="data-label">ID :</span>
                                    <span class="data-value">{{ $shipment->qr_code ?? 'd2203ba3-f222-4217-a0de-ed49f87c10b0' }}</span>
                                </div>
                                <div class="data-field">
                                    <span class="data-label">Company Name :</span>
                                    <span class="data-value">{{ $shipment->exporter_name ?? 'SHAHIR TEJARAT AZARBAIJAN MAKU FREE ZONE' }}</span>
                                </div>
                                
                                <div class="data-field">
                                    <span class="data-label">Commercial ID :</span>
                                    <span class="data-value">{{ $shipment->exporter_id ?? '14012706814' }}</span>
                                </div>
                                <div class="data-field">
                                    <span class="data-label">Address :</span>
                                    <span class="data-value">{{ $shipment->exporter_address ?? '. . Tabriz null null' }}</span>
                                </div>
                                
                                <div class="data-field inline">
                                    <span class="data-label">Tel :</span>
                                    <span class="data-value">09111111111</span>
                                </div>
                                <div class="data-field">
                                    <span class="data-label">By Order :</span>
                                    <span class="data-value">{{ $shipment->exporter_order ?? 'JAM TABRIZ STEEL CO' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Consignee -->
                <div class="accordion-item">
                    <button class="accordion-header" aria-expanded="true">
                        <svg class="icon" viewBox="0 0 24 24" width="16" height="16">
                            <path fill="currentColor" d="M8 5v14l11-7z"/>
                        </svg>
                        <span class="title">Consignee</span>
                        <div class="line"></div>
                    </button>
                    <div class="accordion-content">
                        <div class="content-inner">
                            <div class="data-grid">
                                <div class="data-field">
                                    <span class="data-label">Destination Country :</span>
                                    <span class="data-value">{{ $shipment->consignee_country ?? 'Syrian Arab Republic' }}</span>
                                </div>
                                <div class="data-field inline">
                                    <span class="data-label">Consignee Name :</span>
                                    <span class="data-value">{{ $shipment->consignee_name ?? 'YASER HAJ HAMDA' }}</span>
                                </div>
                                
                                <div class="data-field inline">
                                    <span class="data-label">Consignee Address :</span>
                                    <span class="data-value">{{ $shipment->consignee_address ?? 'SYRIA' }}</span>
                                </div>
                                <div class="data-field inline">
                                    <span class="data-label">Notify to :</span>
                                    <span class="data-value" style="color: #94a3b8;">No information found.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transportation -->
                <div class="accordion-item">
                    <button class="accordion-header" aria-expanded="true">
                        <svg class="icon" viewBox="0 0 24 24" width="16" height="16">
                            <path fill="currentColor" d="M8 5v14l11-7z"/>
                        </svg>
                        <span class="title">Transportation</span>
                        <div class="line"></div>
                    </button>
                    <div class="accordion-content">
                        <div class="content-inner">
                            <div class="data-field inline" style="margin-bottom: 2rem;">
                                <span class="data-label">Export Type :</span>
                                <span class="data-value">On Ground</span>
                            </div>
                            
                            <div class="custom-table-container">
                                <div class="table-header-title">Transportation Table</div>
                                <div class="table-responsive">
                                    <table class="custom-table">
                                        <thead>
                                            <tr>
                                                <th>Row</th>
                                                <th>Goods<br>Delivery<br>Border</th>
                                                <th>Transit Type Title</th>
                                                <th>Vehicle Specification</th>
                                                <th>Bill Of<br>Landing<br>Serial</th>
                                                <th>Transit<br>Descriptio<br>n</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>_</td>
                                                <td>On Ground</td>
                                                <td>{{ $shipment->plate ?? '-' }}</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-pagination">
                                    <button class="page-btn disabled">&lt;</button>
                                    <button class="page-btn active">1</button>
                                    <button class="page-btn disabled">&gt;</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Goods -->
                <div class="accordion-item">
                    <button class="accordion-header" aria-expanded="true">
                        <svg class="icon" viewBox="0 0 24 24" width="16" height="16">
                            <path fill="currentColor" d="M8 5v14l11-7z"/>
                        </svg>
                        <span class="title">Goods</span>
                        <div class="line"></div>
                    </button>
                    <div class="accordion-content">
                        <div class="content-inner">
                            <div class="custom-table-container">
                                <div class="table-header-title">Goods Table</div>
                                <div class="table-responsive">
                                    <table class="custom-table" style="white-space: nowrap;">
                                        <thead>
                                            <tr>
                                                <th>Row</th>
                                                <th>HS Code</th>
                                                <th>Title</th>
                                                <th>amount</th>
                                                <th>Unit Type Title</th>
                                                <th>Second Amount</th>
                                                <th>Second Unit Type Title</th>
                                                <th>Origin Criterion</th>
                                                <th>Gross Weight</th>
                                                <th>Net Weight</th>
                                                <th>Weight Unit Title</th>
                                                <th>Invoice Number</th>
                                                <th>Invoice Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>72071190</td>
                                                <td>--- Other</td>
                                                <td>1402</td>
                                                <td>Branch</td>
                                                <td>-</td>
                                                <td></td>
                                                <td>P</td>
                                                <td>{{ $shipment->tonnage ?? '2113430' }}</td>
                                                <td>{{ $shipment->tonnage ?? '2113430' }}</td>
                                                <td>Kg</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-pagination">
                                    <button class="page-btn disabled">&lt;</button>
                                    <button class="page-btn active">1</button>
                                    <button class="page-btn disabled">&gt;</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- For official use -->
                <div class="accordion-item">
                    <button class="accordion-header" aria-expanded="true">
                        <svg class="icon" viewBox="0 0 24 24" width="16" height="16">
                            <path fill="currentColor" d="M8 5v14l11-7z"/>
                        </svg>
                        <span class="title">For official use</span>
                        <div class="line"></div>
                    </button>
                    <div class="accordion-content">
                        <div class="content-inner">
                            <div class="data-field inline">
                                <span class="data-label">CO Description :</span>
                                <span class="data-value" style="color: #94a3b8;">No information found.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-actions">
                @if(isset($shipment) && $shipment->pdf_path)
                    <button class="btn btn-outline-blue" onclick="openPdfModal()">See Draft Version</button>
                @endif
                <button class="btn btn-outline-green" onclick="window.print()">Print</button>
                <button class="btn btn-outline-orange" onclick="window.history.back()">Back</button>
            </div>
        </div>
    </main>



    <script src="{{ asset('script.js') }}"></script>
    <script>
        function openPdfModal() {
            @if(isset($shipment) && $shipment->pdf_path)
            const btn = document.querySelector('.btn-outline-blue');
            const originalText = btn.innerText;
            btn.innerText = "Yükleniyor...";
            
            fetch("{{ Storage::url($shipment->pdf_path) }}")
                .then(res => res.blob())
                .then(blob => {
                    const blobUrl = URL.createObjectURL(blob);
                    // Pencere adı ve boyutlarını ayarlıyoruz, pop-up olarak açılması için
                    window.open(blobUrl, 'PDFViewer', 'width=900,height=1000,menubar=no,toolbar=no,location=no,status=no,resizable=yes,scrollbars=yes');
                    btn.innerText = originalText;
                })
                .catch(err => {
                    console.error("PDF yükleme hatası:", err);
                    alert("PDF belgesi yüklenirken bir sorun oluştu.");
                    btn.innerText = originalText;
                });
            @endif
        }
    </script>
</body>
</html>
