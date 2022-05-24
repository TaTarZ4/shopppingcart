console.log("วัดดี");
$(document).ready(function () {

    // **เพิ่มสินค้าลงในตะกร้า
    $("div.add").click(function () {
        let id = $(this).attr("cart");
        let qty = $(this).attr("qty");
        let attr = $("div#" + id);
        qty = $("input#" + qty);
        attr.fadeIn();
        $("#cart").fadeIn();
        qty.val("1");
    });

    // **ลบสินค้าของจากตะกร้า
    $("button.del").click(function () {
        $(this).parent().fadeOut();
        $(this).prev().val("0");
    });
    // **คำนวนราคาสินค้า
    $("html").click(function () {
        let a = 0;
        for (let i = 0; i < $("div.t").length; i++) {
            let price = $("b#a"+(i+1)).attr("price")
            let qty = $("b#a"+(i+1)).next().val()
            let total = price*qty
            a = a+total        
        }
        $("#total").html(a);
    });

});
