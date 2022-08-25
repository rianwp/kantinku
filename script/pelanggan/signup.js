let form = document.getElementById('form-signup')

form.addEventListener("submit", (event) => {
    event.preventDefault()
    let msgErrorEmail = document.getElementById('email-error')
    let msgErrorPassword = document.getElementById('password-error')
    let msgErrorPasswordKonfirmasi = document.getElementById('passwordkonfirmasi-error')
    let msgErrorNama = document.getElementById('nama-error')

    let checkEmail = document.getElementById('email').value
    let checkPassword = document.getElementById('password').value
    let checkPasswordKonfirmasi = document.getElementById('passwordKonfirmasi').value
    let checkNama = document.getElementById('nama').value
  
    if (checkEmail != "" && checkPassword != "" && checkPassword.length >= 8 && checkPassword == checkPasswordKonfirmasi && checkPasswordKonfirmasi != "" && checkNama != ""){
        msgErrorEmail.innerText = ""
        msgErrorPassword.innerText = ""
        msgErrorPasswordKonfirmasi.innerText = ""
        msgErrorNama.innerText = ""

        const signupData = new URLSearchParams
        signupData.append("email", checkEmail)
        signupData.append("password", checkPassword)
        signupData.append("nama", checkNama)

        const authSignup = async function (){
            const response = await fetch("../process/pelanggan/signupauth_pelanggan.php", {
                method : "POST",
                body : signupData
            })
            const result = await response.json()
            return result 
        }
        authSignup().then(response => {
            if(response.success){
                swal("Sign Up Berhasil", response.msg, response.type)
                setTimeout(() => {
                    window.location.href = "/login"
                },1500)
            } else{
                swal("Sign Up Gagal", response.msg, response.type)
            }
        })
    } else{
        if(checkNama == ""){
            msgErrorNama.innerText = "Nama tidak boleh kosong"
        } else{
            msgErrorNama.innerText = ""
        }
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
        if(checkPassword.length < 8){
            msgErrorPassword.innerText = "Password minimal 8 karakter"
        } else{
            msgErrorPassword.innerText = ""
        }
        if(checkPassword != checkPasswordKonfirmasi || checkPasswordKonfirmasi == ""){
            msgErrorPasswordKonfirmasi.innerText = "Password yang dimasukkan tidak sama"
        } else{
            msgErrorPasswordKonfirmasi.innerText = ""
        }
    }
})