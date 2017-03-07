function _(id){return document.getElementById(id);}
function submitForm(){
    _("btn").disabled = true;
    _("status").innerHTML = "Please wait ...";
    var formdata = new FormData();
    formdata.append("fn", _("fn").value);
    formdata.append("e", _("e").value);
    formdata.append("m", _("m").value);
    var ajax = new XMLHttpRequest();
    ajax.open("POST","contact.php");
    ajax.onreadystatechange = function(){
        if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText == "success") {
                _("contactForm").innerHTML = '<h2>Thanks '+_("fn").value+',your message has been sent.</h2>';

            }else{
                _("status").innerHTML = ajax.responseText;
                _("btn").disabled = false;
            }
        }
    }
    ajax.send(formdata);
}