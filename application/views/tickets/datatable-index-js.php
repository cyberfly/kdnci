<script type="text/javascript">
	
	$(document).ready(function(){

		// setup datatables

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


        var table =  $('#datatable').DataTable({


        	// datatable config here


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
            ajax: {
            	url: "<?php echo site_url('ticket/getTicketsDatatable'); ?>",
            	type: "POST"
            },
            columns: [
                // column anda sini
                {
                	"data": "id",
                	"searchable": false
                },
                {
                	"data": "subject"
                },
                {
                	"data": "description",
                    "width": "20%"
                },
                {
                	"data": "ticket_category_name"
                },
                {
                	"data": "edit",
                	"orderable": false
            	},
            ],
            // default order by
            order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                $('td:eq(0)', row).html();
            }


        	// end of datatable config		



        });

    });


</script>