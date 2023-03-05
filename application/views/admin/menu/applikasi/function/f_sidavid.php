<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (
        ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};
var selectedId;
$(document).ready(function() {

    function alert_info(title, label, message) {
        $(document).Toasts('create', {
            body: message,
            class: 'bg-info',
            title: title,
            subtitle: label,
            icon: 'fas fa-envelope fa-lg',
            autohide: true,
            delay: 750
        });
    };

    function alert_warning(title, label, message) {
        $(document).Toasts('create', {
            body: message,
            class: 'bg-warning',
            title: title,
            subtitle: label,
            icon: 'fas fa-envelope fa-lg',
            autohide: true,
            delay: 750
        });
    };

    function alert_success(title, label, message) {
        $(document).Toasts('create', {
            body: message,
            class: 'bg-success',
            title: title,
            subtitle: label,
            icon: 'fas fa-envelope fa-lg',
            autohide: true,
            delay: 750
        });
    };
});
</script>