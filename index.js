 $('.btn-delete').on('click',function(e){
           e.preventDefault();
           const href =$(this).attr('href')

           Swal.fire({
                title: 'Are you Sure?' ,
                text: 'Record will be deleted?' ,
                type: 'warning' ,
                showCancelButton: true,
                confirmButtonColor: '#3085d6' ,
                cancelButtonColor: '#d33' ,
                confirmButtonText: 'Delete Record?' ,
            }).then((result) => {
                if(result.value){
                    document.location.href = href;
                }
            })
       })