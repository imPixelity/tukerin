import {BrowserMultiFormatOneDReader} from "@zxing/browser";
import {BarcodeFormat, DecodeHintType} from "@zxing/library";

let controls = null;
let codeReader = null;
let lastScanned = null;
let lastScannedTime = 0;

const barcodeMap = {};
const SCAN_COOLDOWN = 2000;

document.addEventListener("DOMContentLoaded", init);

function init() {
    const startButton = document.getElementById("start-scan-btn");
    const stopButton = document.getElementById("stop-scan-btn");

    startButton.addEventListener("click", startScan);
    stopButton.addEventListener("click", stopScan);
}

async function startScan() {
    if (controls) {
        return;
    }

    try {
        const hints = createScannerHints();
        const options = createScannerOptions();

        codeReader = new BrowserMultiFormatOneDReader(hints, options);

        const videoElement = document.getElementById("video-scanner");

        const constraints = {
            video: {
                facingMode: "environment",
            },
        };

        controls = await codeReader.decodeFromConstraints(
            constraints,
            videoElement,
            handleScanResult
        );
    } catch (error) {
        console.error("Failed to start scanner:", error);
    }
}

function stopScan() {
    if (controls) {
        controls.stop();
        controls = null;
    }

    codeReader = null;
}

function createScannerHints() {
    const hints = new Map();

    hints.set(DecodeHintType.POSSIBLE_FORMATS, [
        BarcodeFormat.EAN_13,
        BarcodeFormat.UPC_A,
    ]);

    return hints;
}

function createScannerOptions() {
    return {
        delayBetweenScanAttempts: 500,
    };
}

function handleScanResult(result) {
    if (!result) {
        return;
    }

    const barcode = result.getText();
    const now = Date.now();

    if (barcode === lastScanned && now - lastScannedTime < SCAN_COOLDOWN) {
        return;
    }

    lastScanned = barcode;
    lastScannedTime = now;

    updateBarcodeMap(barcode);
}

function updateBarcodeMap(barcode) {
    if (barcodeMap[barcode]) {
        barcodeMap[barcode]++;
        updateBarcodeRow(barcode);
    } else {
        barcodeMap[barcode] = 1;
        createBarcodeRow(barcode);
    }
}

function createBarcodeRow(barcode) {
    const container = document.getElementById("scan-inputs");
    const row = document.createElement("div");
    row.id = `row-${barcode}`;

    const input = document.createElement("input");
    input.type = "text";
    input.name = `barcodes[${barcode}]`;
    input.value = '1';
    input.readOnly = true;
    input.id = `input-${barcode}`;

    const label = document.createElement("span");
    label.id = `qty-${barcode}`;
    label.textContent = `${barcode}`;

    row.appendChild(label);
    row.appendChild(input);
    container.appendChild(row);
}

function updateBarcodeRow(barcode) {
    document.getElementById(`input-${barcode}`).value = barcodeMap[barcode];
}
