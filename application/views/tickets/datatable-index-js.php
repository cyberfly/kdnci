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


        // end of data table


        // when click delete button

        $("#datatable").on("click", ".delete", function() {

            // get clicked button data-id value

            var ticket_id = $(this).attr('data-id');

            // get clicked button data-title value

            var ticket_title = $(this).attr('data-title');

            // get current row

            var current_row = $(this).closest('tr');

            confirmDelete(ticket_id, ticket_title, current_row);
        } );

        // show delete confirm modal

        function confirmDelete(id, title, current_row)
        {
            Swal.fire({
                title: 'Anda pasti nak padam ' + title + '?',
                text: 'Tindakan ini tidak boleh di undur!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, padamlah!',
                cancelButtonText: 'Tidak, masih sayang!'
            }).then((result) => {

                if (result.value) {

                    // submit AJAX request to delete ticket id

                    var ajax_data = {
                        'ticket_id': id
                    };

                    $.ajax({
                        url: "<?php echo site_url('ticket/delete'); ?>",
                        data: ajax_data,
                        method: "POST"
                    }).done(function() {

                        // hide deleted ticket row

                        current_row.hide(1000);

                        // bila dah siap delete baru bagitahu pengguna

                        Swal.fire(
                            'Dah Padam!',
                            'Rekod ini telah pergi',
                            'success'
                        );

                    });


                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire(
                        'Alhamdulillah',
                        'Nasib baik tak padam :)',
                        'error'
                    )
                }
            });

        }

    }); // end of document ready


</script>