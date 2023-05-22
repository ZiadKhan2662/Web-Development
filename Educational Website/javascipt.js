function validate() {

    var Name = document.myForm.name.value;
    var nameregx = /^[A-Za-z ]{1,20}$/;

    var Email = document.myForm.email.value;
    var emailregx = /^[A-Za-z]{1}[A-Za-z_0-9.]{1,}@[A-Za-z]{2,12}[.]{1}[A-Za-z.]{2,8}$/;

    var Password = document.myForm.password.value;
    var passwordregx = /^[A-Za-z]\w{7,14}$/;
    
    
    if (!nameregx.test(Name)) {
        alert("Incorrect name");
        return false;
    }

    if (!emailregx.test(Email)) {
        alert("Password must be between 7-14 characters");
        return false;
    }

    if (!passwordregx.test(Password)) {
        alert("Incorrect Password");
        return false;
    }
    
    return true;
 }

 function searchVideo() 
 {
    var searchQuery = document.getElementsByName("search_box")[0].value.toLowerCase();

    if (searchQuery === "html in 100 seconds" || searchQuery==="html") {
        document.getElementById("video").style.display = "block";
    } else {
        document.getElementById("video").style.display = "none";
    }
}
let profile = document.querySelector('.header .flex .profile');
let search = document.querySelector('.header .flex .search-form');
document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   search.classList.remove('active');
}