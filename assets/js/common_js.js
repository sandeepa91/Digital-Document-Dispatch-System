/**
 * Created by Admin on 8/9/15.
 */

setInterval(function () {
    //check_mail();
}, 60000);

var check_mail = function () {
    $.ajax({
        type: "GET",
        dataType: 'html',
        url: "/index.php/messages/get_inbox_count/",
        success: function (data) {
            if (data == 'error') {
                $('#inbox-count').replaceWith("");
            } else {
                $('#inbox-count').replaceWith(data);
            }
        }
    });
    $.ajax({
        type: "GET",
        dataType: 'html',
        url: "/index.php/messages/notification/",
        success: function (data) {
            $('#mail-notification').replaceWith(data);
        }
    });
};

var show_user_modal = function (parent_view, data, userType) {
    switch (userType) {
        case 'editor':
            //$('#student-modal-title').text(data.first_name + " " + data.last_name);
            //$('#student-modal-title-small').text(data.name);
            //$('#student-name').val(data.first_name + " " + data.last_name);
            //$('#student-address1').val(data.address_1);
            //$('#student-address2').val(data.address_2);
            //$('#student-city').val(data.city);
            //$('#student-dob').val(data.DOB);
            //$('#student-contact_no').val(data.contact_no);
            //if (parent_view == 'registration_requests') {
            //    $('#student-accept').attr('href', BASE_URL + "/users/accept_reject_request/" + data.id + '/accept');
            //    $('#student-reject').attr('href', BASE_URL + "/users/accept_reject_request/" + data.id + '/reject');
            //} else {
            //    $('#student-accept').addClass('hidden');
            //    $('#student-reject').addClass('hidden');
            //}
            $('#modelEditor').modal('show');
            break;
        case 'reviewer':
            //$('#student-modal-title').text(data.first_name + " " + data.last_name);
            //$('#student-modal-title-small').text(data.name);
            //$('#student-name').val(data.first_name + " " + data.last_name);
            //$('#student-address1').val(data.address_1);
            //$('#student-address2').val(data.address_2);
            //$('#student-city').val(data.city);
            //$('#student-dob').val(data.DOB);
            //$('#student-contact_no').val(data.contact_no);
            //if (parent_view == 'registration_requests') {
            //    $('#student-accept').attr('href', BASE_URL + "/users/accept_reject_request/" + data.id + '/accept');
            //    $('#student-reject').attr('href', BASE_URL + "/users/accept_reject_request/" + data.id + '/reject');
            //} else {
            //    $('#student-accept').addClass('hidden');
            //    $('#student-reject').addClass('hidden');
            //}
            $('#modelReviewer').modal('show');
            break;

        default:
            toastr.error('Something went wrong!');
    }
};