 //Eliminar Interactive Registros
                function confirmAndSubmit(event, message, confirmButtonText, cancelButtonText) {
                event.preventDefault(); // Impede o envio do formulário

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });

                swalWithBootstrapButtons.fire({
                    title: message,
                    text: "Não é possível reverter!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: confirmButtonText,
                    cancelButtonText: cancelButtonText,
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                    // Submeter o formulário se o usuário confirmar
                    event.target.closest('form').submit();
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelado",
                        text: "Está acção foi cancelada!",
                        icon: "warning"
                    });
                    }
                });
                }