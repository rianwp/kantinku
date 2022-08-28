let form = document.getElementById('form-login')

form.addEventListener("submit", (event) => {
    event.preventDefault()
    let msgErrorEmail = document.getElementById('email-error')
    let msgErrorPassword = document.getElementById('password-error')

    let checkEmail = document.getElementById('email').value
    let checkPassword = document.getElementById('password').value
  
    if (checkEmail != "" && checkPassword != ""){
        msgErrorEmail.innerText = ""
        msgErrorPassword.innerText = ""

        const loginData = new FormData
        loginData.append("email", checkEmail)
        loginData.append("password", checkPassword)

        const authLogin = async function (){
            const response = await fetch("../process/kios/loginauth_kios.php", {
                method : "POST",
                body : loginData
            })
            const result = await response.json()

            return result 
        }
        authLogin().then(response => {
            if(response.loggedIn){
                swal("Login Berhasil", response.msg, response.type)
                setTimeout(() => {
                    window.location.href = "/dashboardkios"
                },1500)
            } else{
                swal("Login Gagal", response.msg, response.type)
            }
        })
    } else{
        if(checkEmail == ""){
            msgErrorEmail.innerText = "Email tidak boleh kosong"
        } else{
            msgErrorEmail.innerText = ""
        }
        if(checkPassword == ""){
            msgErrorPassword.innerText = "Password tidak boleh kosong"
        } else{
            msgErrorPassword.innerText = ""
        }
    }
})