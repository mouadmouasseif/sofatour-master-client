var managePrestationTable;

$(document).ready(function () {
    // Fonction pour afficher un toast de succès
    function error_toast(title, message) {
        cuteToast({
            type: "success", // or 'info', 'error', 'warning'
            title: title,
            message: message,
            timer: 5000
        });
    }

    const urlParams2 = new URLSearchParams(window.location.search);
    const success = urlParams2.get('success');
    if (success != null) {
        error_toast("Succès", success);
    }
    managePrestationTable = $('#managePrestationTable').DataTable({
        'ajax': '../Controllers/PrestationController/fetchPrestations.php',
        'error': function (xhr, error, code) {
            console.log('Erreur AJAX :', xhr.responseText); // Affiche les erreurs AJAX
        },
        'order': []
    });
    // Ajouter une presta 
    $("#addPrestationModalBtn").unbind('click').bind('click', function () {
        // Réinitialiser le formulaire
        $("#submitPrestationForm")[0].reset();

        $(".text-danger").remove();
        $(".form-group").removeClass('has-error').removeClass('has-success');

        $("#submitPrestationForm").unbind('submit').bind('submit', function () {
            var designation = $("#designation").val();
            var prestation = $("#prestation").val();
            var type = $("#type").val();
            var societe = $("#societe").val();

            if (designation == "") {
                $("#designation").after('<p class="text-danger">Ce champ est obligatoire</p>');
                $('#designation').closest('.form-group').addClass('has-error');
            } else {
                $('#designation').closest('.form-group').addClass('has-success');
            }

            if (prestation == "") {
                $("#prestation").after('<p class="text-danger">Ce champ est obligatoire</p>');
                $('#prestation').closest('.form-group').addClass('has-error');
            } else {
                $('#prestation').closest('.form-group').addClass('has-success');
            }

            if (type == "") {
                $("#type").after('<p class="text-danger">Veuillez sélectionner un type</p>');
                $('#type').closest('.form-group').addClass('has-error');
            } else {
                $('#type').closest('.form-group').addClass('has-success');
            }

            if (societe == "") {
                $("#societe").after('<p class="text-danger">Veuillez sélectionner une société</p>');
                $('#societe').closest('.form-group').addClass('has-error');
            } else {
                $('#societe').closest('.form-group').addClass('has-success');
            }

            if (designation && prestation && type && societe) {
                var form = $(this);

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if (response.success == true) {
                            // Réinitialisation après ajout
                            $("#submitPrestationForm")[0].reset();
                            $("#addPrestationModal").modal('hide');

                            // Recharger la table
                            managePrestationTable.ajax.reload(null, false);

                            // Notification de succès
                            error_toast("Succès", response.messages);
                        } else {
                            error_toast("Erreur", response.messages);
                        }
                    }
                });
            }

            return false;
        });
    });

    // Supprimer une presta 
    window.removePrestation = function (prestationId = null) {
        if (prestationId) {
            $("#removePrestationBtn").unbind('click').bind('click', function () {
                $.ajax({
                    url: '../Controllers/PrestationController/removePrestation.php',
                    type: 'post',
                    data: { prestationId: prestationId },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success == true) {
                            $("#removePrestationModal").modal('hide');
                            managePrestationTable.ajax.reload(null, false);
                            error_toast("Succès", response.messages);
                        } else {
                            error_toast("Erreur", response.messages);
                        }
                    }
                });
            });
        } else {
            alert("Erreur : ID manquant.");
        }
    };

    // Éditer une prestation
    window.editPrestation = function (prestationId = null) {
        if (prestationId) {
            $(".text-danger").remove();
            $(".form-group").removeClass('has-error').removeClass('has-success');
            $(".div-loading").removeClass('div-hide');
            $(".div-result").addClass('div-hide');
        
            $.ajax({
                url: '../Controllers/PrestationController/fetchSelectedPrestation.php',
                type: 'post',
                data: { prestationId: prestationId },
                dataType: 'json',
                success: function (response) {
                    $(".div-loading").addClass('div-hide');
                    $(".div-result").removeClass('div-hide');
                
                    // Remplir les champs avec les données reçues
                    $("#editDesignation").val(response.designation);
                    $("#editPrestation").val(response.prestation);
                    $("#editType").val(response.type_id);
                    $("#editSociete").val(response.societe_id);
                
                    // Assurez-vous que `prestationId` est ajouté en tant qu'input hidden
                    if ($('#editPrestationForm input[name="prestationId"]').length === 0) {
                        $('#editPrestationForm').append(
                            `<input type="hidden" name="prestationId" value="${prestationId}">`
                        );
                    } else {
                        $('#editPrestationForm input[name="prestationId"]').val(prestationId);
                    }
                
                    // Gestion de la soumission du formulaire
                    $("#editPrestationForm").unbind('submit').bind('submit', function () {
                        var designation = $("#editDesignation").val();
                        var prestation = $("#editPrestation").val();
                        var type = $("#editType").val();
                        var societe = $("#editSociete").val();
                    
                        $(".text-danger").remove();
                        $(".form-group").removeClass('has-error');
                    
                        if (designation.trim() === "") {
                            $("#editDesignation").after('<p class="text-danger">Ce champ est obligatoire</p>');
                            $('#editDesignation').closest('.form-group').addClass('has-error');
                            return false;
                        }
                        if (prestation.trim() === "") {
                            $("#editPrestation").after('<p class="text-danger">Ce champ est obligatoire</p>');
                            $('#editPrestation').closest('.form-group').addClass('has-error');
                            return false;
                        }
                        if (type.trim() === "") {
                            $("#editType").after('<p class="text-danger">Veuillez sélectionner un type</p>');
                            $('#editType').closest('.form-group').addClass('has-error');
                            return false;
                        }
                        if (societe.trim() === "") {
                            $("#editSociete").after('<p class="text-danger">Veuillez sélectionner une société</p>');
                            $('#editSociete').closest('.form-group').addClass('has-error');
                            return false;
                        }
                    
                        // Soumettre le formulaire via AJAX
                        var form = $(this);
                    
                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: form.serialize(),
                            dataType: 'json',
                            success: function (response) {
                                if (response.success === true) {
                                    $("#editPrestationModal").modal('hide');
                                    managePrestationTable.ajax.reload(null, false);
                                    cuteToast({
                                        type: "success",
                                        title: "Succès",
                                        message: response.messages,
                                        timer: 5000
                                    });
                                } else {
                                    cuteToast({
                                        type: "error",
                                        title: "Erreur",
                                        message: response.messages,
                                        timer: 5000
                                    });
                                }
                            },
                            error: function (xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    
                        return false;
                    });
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        } else {
            alert("Erreur : ID manquant.");
        }
    };


});
