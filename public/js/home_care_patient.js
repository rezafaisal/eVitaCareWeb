document.addEventListener("DOMContentLoaded", function(){
    const table = $("#order-table").dataTable({
        processing: true,
        serverSide: true,
        searching: true,
        dom: 'Brtip',
        ajax : `${window.location.href}/datatable`,
        columns: [
            { data: 'no', name: 'no', orderable: false, searchable: false },
            { data: 'name', name: 'name'},
            { data: 'gender', name: 'gender'},
            { data: 'age', name: 'age'},
            { data: 'registration_date', name: 'registration_date'},
            { data: 'begin_date', name: 'begin_date'},
            { data: 'final_date', name: 'final_date'},
            { data: 'status', name: 'status'},
            { data: 'dpjp', name: 'dpjp'},
            { 
                data: 'action', 
                name: 'action',
                orderable: false, 
                searchable: false,
                render: function(_, type, data, meta){
                    var baseUrl = window.location.href.split('/');
                    baseUrl.pop();
                    baseUrl = baseUrl.join('/');
                    return `
                    <div class="d-flex justify-content-start">
                        <a class="btn btn-icon btn-outline-primary" href="${baseUrl}/patient/${data.id}/detail">
                            <i class="fas fa-info"></i>
                        </a>
                        <button class="btn btn-icon btn-outline-secondary ml-2 btn-change-dpjp" data-toggle="modal" data-target="#dpjp-modal" id="${data.id}-${data.dpjp_id}">
                            <i class="fas fa-user-md"></i>
                        </button>
                        ${data.status_id == 3 ? '' : `
                            <button class="btn btn-icon btn-outline-secondary ml-2 btn-change-status" data-toggle="modal" data-target="#status-modal" id="${data.id}-${data.status_id}">
                                <i class="fas fa-edit"></i>
                            </button>
                        `}
                    </div>
                    `;
                }
            },
        ], 
        createdRow: function( row, data, dataIndex ){
            for(var i = 1; i <= 10; i++){
                if(i === 2 || i === 7){
                    $(row).children(`:nth-child(${i})`).addClass(`align-middle`);
                }else{
                    $(row).children(`:nth-child(${i})`).addClass(`text-center align-middle`);
                }
            }
        },
        initComplete: function () {
            this.api().columns().every(function () {
                var table = this;
    
                // Event Form Input
                $('input', this.footer()).on('keyup change clear', function () {
                    table.search(this.value).draw();
                });

                // Event Form Dropdown
                $('select', this.footer()).on('keyup change clear', function () {
                    table.search(this.value).draw();
                });
            });
        }   
    }); 

    // Pembuatan Individual Search Pada Bagian Footer
    $('#order-table tfoot th').each(function (index) {
        var name = $(this).attr('id');
    
        if(name === "name" || name === "age" || name === "dpjp"){
            $(this).html(`
                <div class="form-group mb-0">
                    <input type="text" class="form-control text-center" name="${name}" placeholder="Cari ${$(this).html()}" id="${name}-form" data-index="${index}">
                </div>
            `);
        }else if(["begin_date", "registration_date", "final_date"].includes(name)){
            $(this).html(`
                <div class="form-group mb-0">
                    <input type="month" class="form-control text-center" name="${name}" id="${name}-form" data-index="${index}">
                </div>
            `);
        }
    });

    $('#order-table').on('draw.dt', function (datatable) {
        const changeStatusButtons = datatable.target.getElementsByClassName('btn-change-status');
        for(let button of changeStatusButtons){
            button.addEventListener('click', function(event){
                const dataId = event.target.id.split("-")[0];
                const statusId = event.target.id.split("-")[1];
                document.getElementById('status-change-form').value = statusId;
                document.getElementById('btn-status-form-submit').onclick = async function(){
                    const newStatusId = document.getElementById('status-change-form').value;

                    const response = await fetch(
                        `${window.location.href}/${dataId}/change-status/${newStatusId}`,
                        { method: "GET", headers: {'Content-Type': 'application/json'}}
                    );
        
                    var {status, title, message} = await response.json();
                    document.getElementById('btn-close-status').click();
                    Swal.fire({
                        icon: status, 
                        title: title, 
                        text: message
                    });

                    if(status == 'success'){
                        table.api().ajax.reload(null, false);
                    }
                }
            });
        }


        const changeDpjpButtons = datatable.target.getElementsByClassName('btn-change-dpjp');
        for(let button of changeDpjpButtons){
            button.addEventListener('click', function(event){
                const dataId = event.target.id.split("-")[0];
                const dpjpId = event.target.id.split("-")[1];
                document.getElementById('dpjp-change-form').value = dpjpId;
                document.getElementById('btn-dpjp-form-submit').onclick = async function(){
                    const newDpjpId = document.getElementById('dpjp-change-form').value;

                    const response = await fetch(
                        `${window.location.href}/${dataId}/change-dpjp/${newDpjpId}`,
                        { method: "GET", headers: {'Content-Type': 'application/json'}}
                    );
        
                    var {status, title, message} = await response.json();
                    document.getElementById('btn-close-dpjp').click();
                    Swal.fire({
                        icon: status, 
                        title: title, 
                        text: message
                    });

                    if(status == 'success'){
                        table.api().ajax.reload(null, false);
                    }
                }
            });
        }
    });
});