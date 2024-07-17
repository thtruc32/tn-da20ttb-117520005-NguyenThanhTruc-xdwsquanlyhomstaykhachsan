<?php include("header.php");
include("ketnoi.php");
?>
<style>
    h6 {
        font-size: 1.5rem;
        font-family: Tahoma;
        color: #40679E;
        font-weight: 600;
    }

    .btt {
        display: flex;
        gap: 4px;
        align-items: center;
        justify-content: center;
        height: 50px;
    }

    .eye {
        color: #65B741;
        height: 25px;
        border: 1.5px solid #65B741;
        background-color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 3px;
    }

    .print {
        color: red;
        height: 25px;
        border: 1.5px solid red;
        background-color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 3px;
    }

    .table th, .table td {
        text-align: center;
        vertical-align: middle;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6>QUẢN LÝ ĐÁNH GIÁ CỦA KHÁCH HÀNG</h6>
            </div>

            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th>Mã đánh giá</th>
                            <th>Tài khoản khách hàng</th>
                            <th>Loại phòng</th>
                            <th>Nội dung đánh giá</th>
                            <th>Ngày đánh giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM danh_gia";
                        $kq = mysqli_query($conn, $sql) or die("Không thể xuất thông tin hoá đơn: " . mysqli_error($conn));
                        while ($row = mysqli_fetch_array($kq)) {
                           

                            $khach_hangs = $row["ma_kh"];
                            $sql3 = "SELECT * FROM khach_hang WHERE ma_kh='$khach_hangs'";
                            $kq3 = mysqli_query($conn, $sql3) or die("Không thể xuất thông tin: " . mysqli_error($conn));
                            $khach_hang = mysqli_fetch_array($kq3);

                            $loai_phongs = $row["ma_loai"];
                            $sql4 = "SELECT * FROM loai_phong WHERE ma_loai='$loai_phongs'";
                            $kq4 = mysqli_query($conn, $sql4) or die("Không thể xuất thông tin: " . mysqli_error($conn));
                            $loai_phong = mysqli_fetch_array($kq4);

                            echo "<tr>";
                            echo "<td>" . $row["ma_danh_gia"] . "</td>";
                            echo "<td>" . $khach_hang["emailkh"] . "</td>";
                            echo "<td>" . $loai_phong["ten_loai"] . "</td>";
                            echo "<td>" . $row["noi_dung"] . "</td>";
                            echo "<td>" . date('d/m/Y', strtotime($row["ngay_danh_gia"])) . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>

<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "Không có dữ liệu",
                "info": "Đang hiển thị _START_ đến _END_ của _TOTAL_ mục",
                "infoEmpty": "Đang hiển thị 0 đến 0 của 0 mục",
                "infoFiltered": "(đã lọc từ tổng số _MAX_ mục)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Hiển thị _MENU_ mục",
                "loadingRecords": "Đang tải...",
                "processing": "Đang xử lý...",
                "search": "Tìm kiếm:",
                "zeroRecords": "Không tìm thấy kết quả phù hợp",
                "paginate": {
                    "first": "Đầu",
                    "last": "Cuối",
                    "next": "Tiếp",
                    "previous": "Trước"
                },
                "aria": {
                    "sortAscending": ": sắp xếp tăng dần",
                    "sortDescending": ": sắp xếp giảm dần"
                },
                "searchPlaceholder": "Tìm kiếm..."
            },
            "pageLength": 10,
       
        });
    });
</script>
