<script>

    $(document).ready(function(){

        // Setup datatables
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
        {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        var table = $("#datatable").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#datatable_filter input')
                    .off('.DT')
                    .on('input.DT', function() {
                        api.search(this.value).draw();
                    });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            ajax: {"url": "<?php echo base_url().'/datatable/getproducts'?>", "type": "POST"},
            columns: [
                {"data": "product_id"},
                {"data": "product_code"},
                {"data": "product_title"},
                //render number format for price
                {"data": "product_price", render: $.fn.dataTable.render.number(',', '.', '')},
                {"data": "category_title"},
                {"data": "view"}
            ],
            order: [[1, 'asc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                $('td:eq(0)', row).html();
            },
            "columnDefs": [ {
                "targets": 5,
                "orderable": false
            } ]

        });

        // end setup datatables

    });

</script>