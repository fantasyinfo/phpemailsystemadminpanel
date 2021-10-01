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
          $("#regForm")[0].reset();
          $("#reg_submit").val("Register");
          $("#reg_submit").attr("disabled", false);
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

  // delete user send to trash

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
          window.location.href = "inbox.php";
        }
      },
    });
  });
}); // document ready function ends here
