@extends('products.layout')

@section('content')

<!-- การสร้างรายการสินค้า -->
    <div id="creteproduct" class="alert" style="display: none;">
        <div>
            <label for="">Name</label>
            <input type="text" class="name" id="create_name">
        </div>
        <div>
            <label for="">Price</label>
            <input type="text" class="price" id="create_price">
        </div>
        <div>
            <label for="">Img</label>
            <input type="text" class="img" id="create_img">
        </div>
        <div>
            <button id="add_item" class="btn btn-success">บันทึก</button>
            <button id="cancel_item" class="btn btn-danger">ยกเลิก</button>
        </div>
    </div>
<!-- จบการสร้างรายการสินค้า -->

<!-- การแก้ไขรายการสินค้า -->
    <div id="editproduct" class="alert" style="display: none;">
        <div style="display: none;">
            <input type="text" id="edit_id">
        </div>
        <div>
            <label for="">Name</label>
            <input type="text" id="edit_name">
        </div>
        <div>
            <label for="">Price</label>
            <input type="text" id="edit_price">
        </div>
        <div>
            <label for="">Img</label>
            <input type="text" id="edit_img">
        </div>
        <div>
            <button id="edit_item" class="btn btn-success">บันทึก</button>
            <button id="editclose" class="btn btn-danger">ยกเลิก</button>
        </div>  
    </div>
<!-- จบการแก้ไขรายการสินค้า -->

<!-- ลบรายการสินค้า -->
    <div id="deleteproduct" class="alert" style="display: none;">
        <div style="display: none;">
            <input type="text" id="delete_id">
        </div>
        <div>
            <button id="deletesubmit" class="btn btn-success">ยืนยัน</button>
            <button id="deleteclose" class="btn btn-danger">ยกเลิก</button>
        </div>
    </div>    
<!-- จบการลบรายการสินค้า -->  

<!-- แสดงรายการสินค้า -->
    <section>
        <div class="text-center">
                <button id="create-button" class="btn btn-success">สร้างสินค้า</button>
        </div>
        <table>
            
            <thead>
                <th>Name</th>
                <th>Price</th>
                <th>artion</th>
            </thead>
            <tbody>
            </tbody>
        </table>
    </section>
<!-- จบการแสดงรายการสินค้า -->

@endsection

@section('script')
<script>
    $(document).ready(function() {

// รายการสินค้า1
        fetchproduct()
        function fetchproduct() {
            $.ajax({
                type: "GET",
                url: "/fetch",
                dataType: "json",
                success: function(response) {
                    $('tbody').html("")
                    $.each(response.product, function(key, item) {
                        $("tbody").append('<tr><td>' + item.name + '</td>\
                        <td>' + item.price + '</td>\
                        <td><button class="edit btn btn-warning" value='+item.id+' >แก้ไช</button>\
                        <button class="delete btn btn-danger" value='+item.id+'>ลบ</button></td></tr>')
                    });
                }
            });
        }

// ลบรายการสินค้า
        $(document).on('click','.delete', function(e){
            e.preventDefault();
            let pro_id = $(this).val()
            $("#delete_id").val(pro_id)
            $("#deleteproduct").fadeIn()
            $("#editproduct").fadeOut()

        })

        $(document).on('click','#deletesubmit', function(e){
            e.preventDefault();
                let pro_id = $("#delete_id").val()
                console.log(pro_id)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "DELETE",
                url: "/delete-product/"+pro_id,
                success: function(response) {
                }
            });
            fetchproduct()  
            $("#deleteproduct").fadeOut()       
        })

        $("#deleteclose").click(function(){
            $("#deleteproduct").fadeOut()
        })
// แก้ไขสินค้า
        $(document).on('click','.edit',function(e){
            e.preventDefault()
            let pro_id = $(this).val();
            $('#editproduct').fadeIn();
            $.ajax({
                type: "GET",
                url: "/edit-product/"+pro_id,
                dataType: "json",
                success: function (response){ 
                    $("#edit_id").val(response.product.id) 
                    $("#edit_name").val(response.product.name)
                    $("#edit_price").val(response.product.price)
                    $("#edit_img").val(response.product.img)
                }
            })
            $("#deleteproduct").fadeOut()

        });
        
        // ยกเลิกการแก้ไข
        $("#editclose").click(function(){
            $("#editproduct").fadeOut();
        })

        // บันทึกการแก้ไข
        $(document).on('click', '#edit_item', function(e) {
            e.preventDefault();
            let pro_id = $("#edit_id").val();
            let data = {
                'name': $('#edit_name').val(),
                'price': $('#edit_price').val(),
                'img': $('#edit_img').val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "PUT",
                url: "/update-product/"+pro_id,
                dataType: "json",
                data: data,
                success: function(response) {
                }
            });

            $("#edit_item").click(function(){
                $("#editproduct").fadeOut();
            })

            fetchproduct()
        });

// สร้างรายการสินค้า +แสดงสินค้า2
        $(document).on('click', '#add_item', function(e) {
            e.preventDefault();
            let data = {
                'name': $('#create_name').val(),
                'price': $('#create_price').val(),
                'img': $('#create_img').val(),
            }
            console.log(data);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/products",
                dataType: "json",
                data: data,
                success: function(response) {}
            });
            $("input").val("");
            $("#creteproduct").fadeOut()
            fetchproduct()
        });

        $("#create-button").click(function(){
            $("#creteproduct").fadeIn()
        })
        $("#cancel_item").click(function(){
            $("#creteproduct").fadeOut()
        })
    });
</script>
@endsection