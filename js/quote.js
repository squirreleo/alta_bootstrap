$(function() {
    $("input, textarea").jqBootstrapValidation(
            {
                preventSubmit: true,
                submitError: function($form, event, errors) {
                    // nothing here right now
                },
                submitSuccess: function($form, event) {
                    event.preventDefault(); // prevent default submit behavior
                    // get values from form
                    var name = $("input#inputName").val();
                    var company = $("input#inputCompany").val();
                    var email = $("input#inputEmail").val();
                    var phone = $("input#inputPhone").val();
                    var quantity = $("input#inputQuantity").val();
                    var proj_name = $("input#inputProject").val();
                    var date = $("input#inputDate").val();
                    var details = $("textarea#inputNotes").val();
                    var notcaptcha = $("input#notcaptcha").val();
                    var firstName = name; // for success/failure message
                    // check for white space in name for success/fail message
                    if (firstName.indexOf(' ') >= 0) {
                        firstName = name.split(' ').slice(0, -1).join(' ');
                    }
                    $.ajax({
                        url: "./quote.php",
                        type: "POST",
                        data: {name: name, company: company, email: email, phone: phone, quantity: quantity, project_name: proj_name, date: date, details: details, notcaptcha: notcaptcha},
                        cache: false,
                        success: function() {
                            // Success message
                            if (notcaptcha == "on")
                            $('#success').html("<div class='alert alert-success'>");
                            $('#success > .alert-success').html("<button class='close' type='button' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
                            $('#success > .alert-success').append("<strong>" + firstName + ", your message has been sent.<br />A member of our customer service team will contact you shortly. Thank you!</strong>");
                            $('#success > .alert-success').append('</div>');
                            
                            // Clear all fields
                            $("form").trigger('reset');
                        },
                        error: function() {
                            // fail message
                            $('#success').html("<div class='alert alert-danger'>");
                            $('#success > .alert-danger').html("<button class='close' type='button' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
                            $('#success > .alert-danger').append("<strong>Error! " + firstName + ", please verify that you have entered your name and a valid email address.</strong> You can contact us directly at <a href='mailto:alynch1224@yahoo.com?Subject=Contact Request'>alynch1224@yahoo.com</a> or (352) 372-2534.");
                            $('#success > .alert-danger').append('</div>');
                            
                            // Clear all fields
                            $("form").trigger('reset');                                                      
                        },
                    })
                },
                filter: function() {
                    return $(this).is(":visible");
                },
            });
            
            $("a[data-toggle=\"tab\"]").click(function(e) {
                e.preventDefault();
                $(this).tab("show");
            });
});

// When clicking on first name field, hide fail/success boxes
$('#inputName').focus(function() {
    $('#success').html('<br />');
});



