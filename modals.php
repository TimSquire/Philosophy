<div id="loginModal" class="modal fade" role="dialog">  
      <div class="modal-dialog">  
   <!-- Modal content-->  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Login</h4>  
                </div>  
                <div class="modal-body">  
                     <label>Username</label>  
                     <input type="text" name="username" id="username" class="form-control" />  
                     <br />  
                     <label>Password</label>  
                     <input type="password" name="password" id="password" class="form-control" />  
                     <br />  
                     <button type="button" name="login_button" id="login_button" class="btn btn-primary btn-block">Login</button> 
					 </br>				
                </div>  
           </div>  
      </div>  
 </div>  
 <div id="signupModal" class="modal fade" role="dialog">  
      <div class="modal-dialog">  
   <!-- Modal content-->  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Create Account</h4>  
                </div>  
                <div class="modal-body">  
                     <label>First Name</label>  
                     <input type="text" name="fname" id="fname" class="form-control" />  
                     <label>Last Name</label>  
                     <input type="text" name="lname" id="lname" class="form-control" />  
                     <br />  
					 <label>Username</label>  
                     <input type="text" name="username2" id="username2" class="form-control" />  
					 <label>Pasword</label>  
                     <input type="password" name="cpassword" id="cpassword" class="form-control" />  
                     <br /> 		
					 <label>Confirm Password</label>  
                     <input type="password" name="ccpassword" id="ccpassword" class="form-control" />  
					 <label>Email</label>  
                     <input type="email" name="email" id="email" class="form-control" />  
                     <br/> 
					 <label>Birthdate</label>  
                     <input type="date" name="dob" id="dob" class="form-control" />  
                     <br /> 
                     <button type="button" name="signup_button" id="signup_button" class="btn btn-primary btn-block">Create Account</button> 
					 </br>					
                </div>  
           </div>  
      </div>  
 </div>  
 <div id="edituserModal" class="modal fade" role="dialog">  
      <div class="modal-dialog">  
   <!-- Modal content-->  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Change Username</h4>  
                </div>  
                <div class="modal-body">  
                     <label>Current Username</label>  
                     <input type="text" name="eusername" id="eusername" class="form-control" />  
                     <br />  
                     <label>New Username</label>  
                     <input type="text" name="nusername" id="nusername" class="form-control" />  
                     <br />  
					 <label>Confirm New Username</label>  
                     <input type="text" name="cnusername" id="cnusername" class="form-control" />  
                     <br />  
                     <button type="button" name="edituser_button" id="edituser_button" class="btn btn-primary btn-block">Submit Changes</button> 
					 </br>				
                </div>  
           </div>  
      </div>  
 </div>  
 <div id="editpassModal" class="modal fade" role="dialog">  
      <div class="modal-dialog">  
   <!-- Modal content-->  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Change Password</h4>  
                </div>  
                <div class="modal-body">  
                     <label>Current Password</label>  
                     <input type="password" name="epassword" id="epassword" class="form-control" />  
                     <br />  
                     <label>New Password</label>  
                     <input type="password" name="npassword" id="npassword" class="form-control" />  
                     <br />  
					 <label>Confirm New Password</label>  
                     <input type="password" name="cnpassword" id="cnpassword" class="form-control" />  
                     <br />  
                     <button type="button" name="editpass_button" id="editpass_button" class="btn btn-primary btn-block">Submit Changes</button> 
					 </br>				
                </div>  
           </div>  
      </div>  
 </div>  
<div id="delModal" class="modal fade" role="dialog">  
      <div class="modal-dialog">  
   <!-- Modal content-->  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Delete Account</h4>  
                </div>  
                <div class="modal-body">  
                     <label>Username</label>  
                     <input type="text" name="dusername" id="dusername" class="form-control" />  
                     <br />  
                     <label>Password</label>  
                     <input type="password" name="dpassword" id="dpassword" class="form-control" />  
                     <br />  
                     <button type="button" name="del_button" id="del_button" class="btn btn-primary btn-block">Delete Account</button> 
					 </br>				
                </div>  
           </div>  
      </div>  
 </div> 
<div id="authModal" class="modal fade" role="dialog">  
      <div class="modal-dialog">  
   <!-- Modal content-->  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Become an author</h4>  
                </div>  
                <div class="modal-body">  
                     <label>Username</label>  
                     <input type="text" name="ausername" id="ausername" class="form-control" />  
                     <br />  
                     <label>Password</label>  
                     <input type="password" name="apassword" id="apassword" class="form-control" />  
                     <br />  
                     <button type="button" name="auth_button" id="auth_button" class="btn btn-primary btn-block">Become an Author!</button> 
					 </br>				
                </div>  
           </div>  
      </div>  
 </div> 
 <script>  
 $(document).ready(function(){  
      $('#login_button').click(function(){  
           var username = $('#username').val();  
           var password = $('#password').val();  
           if(username != '' && password != '')  
           {  
                $.ajax({  
                     url:"action.php",  
                     method:"POST",  
                     data: {username:username, password:password},  
                     success:function(data)  
                     {  
                          //alert(data);  
                          if(data == 'No')  
                          {  
                               alert("Incorrect Password");
								
                          }   
                          else  
                          { 
							if(data == 'IU'){
								alert("Invalid Username")
							} else {					  
                               $('#loginModal').hide();  
                               location.reload(); 
							}
                          }  
                     }  
                });  
           }  
           else  
           {  
                alert("Both Fields are required");  
           }  
      });  
      $('#logout').click(function(){  
           var action = "logout";  
           $.ajax({  
                url:"action.php",  
                method:"POST",  
                data:{action:action},  
                success:function()  
                {  
                     location.reload();  
                }  
           });  
      });  
 });
 $(document).ready(function(){  
      $('#signup_button').click(function(){  
           var fname = $('#fname').val();  
           var lname = $('#lname').val();  
		   var username2 = $('#username2').val();  
           var cpassword = $('#cpassword').val();  
		   var ccpassword = $('#ccpassword').val();  
           var email = $('#email').val();  
           var dob = $('#dob').val();  
           if(fname != '' && lname != '' && username2 != '' && cpassword != '' && ccpassword != '' && email != '' && dob != '')  
           {  
                $.ajax({  
                     url:"action2.php",  
                     method:"POST",  
                     data: {fname:fname, lname:lname, username2:username2, cpassword:cpassword, ccpassword:ccpassword, email:email, dob:dob},  
                     success:function(data)  
                     {  
                          //alert(data);  
                          if(data == 'invalidfname')  
                          {  
                               alert("Invalid First Name");
								
                          } else {
							  if(data == 'invalidlname')  
							  {  
								   alert("Invalid Last Name");
									
							  } else {
								  if(data == 'invalidemail')  
									{  
									alert("Invalid Email");								
									} else {
										if(data == 'wrongpwds')  
										{  
											alert("Passwords don't match");						
										} else {
											if(data == 'taken')  
											{  
												alert("That username is already taken");												
											} else {  
											   $('#signupModal').hide();  
											   location.reload(); 
											}
												
										}  
									}
								} 
						  }	
					 }						  
                });  
           }  
           else  
           {  
                alert("All Fields are required");  
           }  
      }); 
 });
 $(document).ready(function(){  
      $('#edituser_button').click(function(){  
           var eusername = $('#eusername').val();  
           var nusername = $('#nusername').val();  
		   var cnusername = $('#cnusername').val();  
           if(username != '' && nusername != '' && cnusername != '')  
           {  
                $.ajax({  
                     url:"action3.php",  
                     method:"POST",  
                     data: {eusername:eusername, nusername:nusername, cnusername:cnusername},  
                     success:function(data)  
                     {  
                           //alert(data);  
                          if(data == 'icu')  
                          {  
                               alert("Incorrect Current Username");
								
                          }  
                          else  
                          { 
							if(data== 'nudm'){
								alert("New usernames don't match")
							} 
							else  
                            { 
							if(data== 't'){
								alert("New Username is already Taken")
							}else {				  
                               $('#delModal').hide();  
                               location.reload(); 
                          }  
						}  
						}
                     }  
                });  
           }  
           else  
           {  
                alert("All Fields are required");  
           }  
      });    
 });
 $(document).ready(function(){  
      $('#editpass_button').click(function(){  
           var epassword = $('#epassword').val();  
           var npassword = $('#npassword').val();  
		   var cnpassword = $('#cnpassword').val();  
           if(epassword != '' && npassword != '' && cnpassword != '')  
           {  
                $.ajax({  
                     url:"action4.php",  
                     method:"POST",  
                     data: {epassword:epassword, npassword:npassword, cnpassword:cnpassword},  
                     success:function(data)  
                     {  
                          //alert(data);  
                          if(data == 'icp')  
                          {  
                               alert("Incorrect Current Password");
								
                          }  
                          else  
                          {
								if(data == 'npdm'){
								   alert("New Passwords don't match");
								} else {
									$('#edituserModal').hide();  
								   location.reload(); 
								}
                          }  
                     }  
                });  
           }  
           else  
           {  
                alert("All Fields are required dawg");  
           }  
      });    
 });
 $(document).ready(function(){  
      $('#del_button').click(function(){  
           var dusername = $('#dusername').val();  
           var dpassword = $('#dpassword').val();  
           if(dusername != '' && dpassword != '')  
           {  
                $.ajax({  
                     url:"action5.php",  
                     method:"POST",  
                     data: {dusername:dusername, dpassword:dpassword},  
                     success:function(data)  
                     {  
                          //alert(data);  
                          if(data == 'iu')  
                          {  
                               alert("Incorrect Username");
								
                          }  
                          else  
                          {  
							if(data == 'ip')  
                          {  
                               alert("Incorrect Password");
								
                          }  
                          else {
                               $('#delModal').hide();  
                               location.reload(); 
                          } 
					  }						  
                     }  
                });  
           }  
           else  
           {  
                alert("Both Fields are required");  
           }  
      });  
      $('#logout').click(function(){  
           var action = "logout";  
           $.ajax({  
                url:"action5.php",  
                method:"POST",  
                data:{action:action},  
                success:function()  
                {  
                     location.reload();  
                }  
           });  
      });  
 });
 $(document).ready(function(){  
      $('#auth_button').click(function(){  
           var ausername = $('#ausername').val();  
           var apassword = $('#apassword').val();  
           if(ausername != '' && apassword != '')  
           {  
                $.ajax({  
                     url:"action6.php",  
                     method:"POST",  
                     data: {ausername:ausername, apassword:apassword},  
                     success:function(data)  
                     {  
                          //alert(data);  
                          if(data == 'iu')  
                          {  
                               alert("Incorrect Username");
								
                          }  
                          else  
                          {  
							if(data == 'ip')  
                          {  
                               alert("Incorrect Password");
								
                          }  
                          else  
                          {  
                               $('#loginModal').hide();  
                               location.reload(); 
                          }  
					  }
                     }  
                });  
           }  
           else  
           {  
                alert("Both Fields are required");  
           }  
      });  
      $('#logout').click(function(){  
           var action = "logout";  
           $.ajax({  
                url:"action.php",  
                method:"POST",  
                data:{action:action},  
                success:function()  
                {  
                     location.reload();  
                }  
           });  
      });  
 });
</script>