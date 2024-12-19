<script setup lang="ts">
import { onMounted, ref, watch } from 'vue';
import JsBarcode from 'jsbarcode';

const props = defineProps({
    value: {
        type: String,
        required: true,
    },
});

const barcodeRef = ref<HTMLCanvasElement | null>(null);

onMounted(() => {
    generateBarcode();
});

watch(() => props.value, () => {
    generateBarcode();
});

const generateBarcode = () => {
    if (barcodeRef.value) {
        JsBarcode(barcodeRef.value, props.value, {
            format: 'CODE128', // Format of the barcode
            lineColor: '#000',
            width: 2,
            height: 40,
            displayValue: true, // Display text below the barcode
        });
    }
};
</script>

<template>
    <canvas ref="barcodeRef"></canvas>
</template>

<style scoped>
canvas {
    display: block;
    margin: auto;
}
</style>
