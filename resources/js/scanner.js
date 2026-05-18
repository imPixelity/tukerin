import {BrowserMultiFormatOneDReader} from "@zxing/browser";
import {BarcodeFormat, DecodeHintType} from "@zxing/library";

let controls = null;
let codeReader = null;

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
        delayBetweenScanSuccess: 2000,
    };
}

function handleScanResult(result) {
    if (!result) {
        return;
    }

    appendBarcode(result.getText());
}

function appendBarcode(barcode) {
    appendBarcodeToList(barcode);
    appendBarcodeInput(barcode);
}

function appendBarcodeToList(barcode) {
    const list = document.getElementById("scan-results");

    const item = document.createElement("li");
    item.textContent = barcode;

    list.appendChild(item);
}

function appendBarcodeInput(barcode) {
    const inputs = document.getElementById("scan-inputs");

    const input = document.createElement("input");
    input.type = "hidden";
    input.name = "barcodes[]";
    input.value = barcode;

    inputs.appendChild(input);
}
