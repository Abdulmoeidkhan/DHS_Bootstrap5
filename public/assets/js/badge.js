$("#barCode").barcode(
    $("#barCode").attr("custom-id"),
    "code128",
    {
        showHRI: false,
        barHeight: 40,
        barWidth: 2,
    }
);