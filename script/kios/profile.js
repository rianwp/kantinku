const msgErrorPassword = document.getElementById('password-error')
const msgErrorEmail = document.getElementById('email-error')
const msgErrorNama = document.getElementById('nama-error')
const msgErrorKonfirmasi = document.getElementById('konfirmasi-error')

const editNama = () => {
    const nama = document.getElementById('nama').value
    const konfirmasi = document.getElementById('konfirmasi-nama').value

    if(nama != "" && konfirmasi != ""){
        msgErrorNama.innerText = ""
        msgErrorKonfirmasi.innerText = ""

        const editNamaData = new FormData
        editNamaData.append("nama", nama)
        editNamaData.append("konfirmasi", konfirmasi)

        const setNama = async function (){
            const response = await fetch("../process/kios/editnama_kios.php", {
                method : "POST",
                body : editNamaData
            })
            const result = await response.json()
            return result 
        }
        setNama().then(response => {
            if(response.success){
                swal("Edit Nama Berhasil", response.msg, response.type)
                setTimeout(() => {
                    location.reload()
                },1500)
            } else{
                swal("Edit Nama Gagal", response.msg, response.type)
            }
        })
    } else{
        if(nama == ""){
            msgErrorNama.innerText = "Nama tidak boleh kosong"
        } else{
            msgErrorNama.innerText = ""
        }
        if(konfirmasi == ""){
            msgErrorKonfirmasi.innerText = "Silahkan isi password untuk konfirmasi"
        } else{
            msgErrorKonfirmasi.innerText = ""
        }
    }
}

const editEmail = () => {
    const email = document.getElementById('email').value
    const konfirmasi = document.getElementById('konfirmasi-email').value
    
    if(email != "" && konfirmasi != ""){
        msgErrorEmail.innerText = ""
        msgErrorKonfirmasi.innerText = ""

        const editEmailData = new FormData
        editEmailData.append("email", email)
        editEmailData.append("konfirmasi", konfirmasi)

        const setEmail = async function (){
            const response = await fetch("../process/kios/editemail_kios.php", {
                method : "POST",
                body : editEmailData
            })
            const result = await response.json()
            return result 
        }
        setEmail().then(response => {
            if(response.success){
                swal("Edit Email Berhasil", response.msg, response.type)
                setTimeout(() => {
                    location.reload()
                },1500)
            } else{
                swal("Edit Email Gagal", response.msg, response.type)
            }
        })
    } else{
        if(email == ""){
            msgErrorEmail.innerText = "Email tidak boleh kosong"
        } else{
            msgErrorEmail.innerText = ""
        }
        if(konfirmasi == ""){
            msgErrorKonfirmasi.innerText = "Silahkan isi password untuk konfirmasi"
        } else{
            msgErrorKonfirmasi.innerText = ""
        }
    }
}

const editPassword = () =>{
    const password = document.getElementById('password').value
    const konfirmasi = document.getElementById('konfirmasi-password').value

    if(password != "" && konfirmasi != ""){
        msgErrorPassword.innerText = ""
        msgErrorKonfirmasi.innerText = ""

        const editPasswordData = new FormData
        editPasswordData.append("password", password)
        editPasswordData.append("konfirmasi", konfirmasi)

        const setPassword = async function (){
            const response = await fetch("../process/kios/editpassword_kios.php", {
                method : "POST",
                body : editPasswordData
            })
            const result = await response.json()
            return result 
        }
        setPassword().then(response => {
            if(response.success){
                swal("Edit Password Berhasil", response.msg, response.type)
                setTimeout(() => {
                    location.reload()
                },1500)
            } else{
                swal("Edit Password Gagal", response.msg, response.type)
            }
        })
    } else{
        if(password == ""){
            msgErrorPassword.innerText = "Nama tidak boleh kosong"
        } else{
            msgErrorPassword.innerText = ""
        }
        if(konfirmasi == ""){
            msgErrorKonfirmasi.innerText = "Silahkan isi password untuk konfirmasi"
        } else{
            msgErrorKonfirmasi.innerText = ""
        }
    }
}
