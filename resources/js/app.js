import Alpine from 'alpinejs';
import QRCode from 'qrcode';

window.Alpine = Alpine;
Alpine.start();

// QR Code Generator
// Finds all elements with [data-qr] and renders a QR canvas inside them.
// Buttons with [data-qr-download] trigger a PNG download.
document.addEventListener('DOMContentLoaded', () => {
    // Render all inline QR canvases
    document.querySelectorAll('[data-qr]').forEach(el => {
        const url = el.dataset.qr;
        const canvas = document.createElement('canvas');
        QRCode.toCanvas(canvas, url, {
            width: parseInt(el.dataset.qrSize || '120'),
            margin: 1,
            color: {
                dark: '#0f172a',
                light: '#ffffff',
            }
        }, (err) => {
            if (!err) el.appendChild(canvas);
        });
    });

    // Download buttons
    document.querySelectorAll('[data-qr-download]').forEach(btn => {
        btn.addEventListener('click', () => {
            const url = btn.dataset.qrDownload;
            const size = parseInt(btn.dataset.qrSize || '512');
            QRCode.toDataURL(url, {
                width: size,
                margin: 2,
                color: {
                    dark: '#0f172a',
                    light: '#ffffff',
                }
            }, (err, dataUrl) => {
                if (err) return;
                const a = document.createElement('a');
                a.href = dataUrl;
                a.download = 'qrcode.png';
                a.click();
            });
        });
    });
});
