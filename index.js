$(document).ready(function () {
  // register user
  $("#reg_submit").click(function (e) {
    //$('#submit').disable();
    $("#reg_submit").val("Please Wait....");
    $("#reg_submit").attr("disabled", true);
    $(".msg").hide();
    e.preventDefault();
    $.ajax({
      url: "manage.php",
      data: $("#regForm").serialize(),
      method: "post",
      success: function (result) {
        result = $.parseJSON(result);

        if (result.status == 404) {
          $("#usernameerror").show();
          $("#reg_submit").val("Register");
          $("#reg_submit").attr("disabled", false);
        } else if (result.status == 304) {
          $("#emailError").show();
          $("#reg_submit").val("Register");
          $("#reg_submit").attr("disabled", false);
        } else if (result.status == 303) {
          $("#emailError").show();
          $("#reg_submit").val("Register");
          $("#reg_submit").attr("disabled", false);
        } else if (result.status == 200) {
          $("#submitMsg").show();
          $("#regForm").hide();
          $("#otpForm").show();
          // $("#reg_submit").val("Register");
          // $("#reg_submit").attr("disabled", false);
        }
        console.log(result);
      },
    });
  });

  //login user
  $("#log_submit").click(function (e) {
    //$('#submit').disable();
    $(".msg").hide();
    e.preventDefault();
    $.ajax({
      url: "manage.php",
      data: $("#loginForm").serialize(),
      method: "post",
      success: function (result) {
        result = $.parseJSON(result);
        console.log(result);
        if (result.status == 303) {
          $("#usernameerror").show();
        } else if (result.status == 304) {
          $("#passFill").show();
        } else if (result.status == 305) {
          $("#passMsg").show();
        } else if (result.status == 200) {
          $("#submitMsg").show();
          $("#loginForm")[0].reset();
          window.location.href = "inbox.php";
        }
      },
    });
  });

  // sending email to user
  $("#ComposeFrm").on("submit", function (e) {
    //$('#submit').disable();
    //alert("clicked");
    $(".msg").hide();
    e.preventDefault();
    $.ajax({
      url: "manage.php",
      data: $("#ComposeFrm").serialize(),
      method: "post",
      success: function (result) {
        result = $.parseJSON(result);
        if (result.status == 200) {
          $("#Msg").show();
          $("#ComposeFrm")[0].reset();
          window.location.href = "send.php";
        }
      },
    });
  });
}); // document ready function ends here

// delete form inbox to transh
function inbox_delete_msg(id) {
  jQuery.ajax({
    url: "manage.php",
    data: "inbox_id=" + id,
    method: "post",
    success: function (response) {
      response = jQuery.parseJSON(response);
      console.log(response);
      if (response.status == 200) {
        //alert("hello");
        jQuery("#inbox_msg_id_" + id).hide();
      }
    },
  });
}

// delete from send to trash
function send_delete_msg(id) {
  jQuery.ajax({
    url: "manage.php",
    data: "send_id=" + id,
    method: "post",
    success: function (response) {
      response = jQuery.parseJSON(response);
      console.log(response);
      if (response.status == 200) {
        //alert("hello");
        jQuery("#send_msg_id_" + id).hide();
      }
    },
  });
}

// delete inbox msg from transh box permanently
function inbox_trash_delete_msg(id) {
  jQuery.ajax({
    url: "manage.php",
    data: "trash_del_id=" + id,
    method: "post",
    success: function (response) {
      response = jQuery.parseJSON(response);
      console.log(response);
      if (response.status == 200) {
        //alert("hello");
        jQuery("#trash_msg_id_" + id).hide();
      }
    },
  });
}

// restore back from transh to inbox
function restore_inbox_delete_msg(id) {
  jQuery.ajax({
    url: "manage.php",
    data: "trash_res_id=" + id,
    method: "post",
    success: function (response) {
      response = jQuery.parseJSON(response);
      console.log(response);
      if (response.status == 200) {
        //alert("hello");
        jQuery("#trash_msg_id_" + id).hide();
      }
    },
  });
}
