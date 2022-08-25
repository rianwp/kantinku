const setLogout = () => {
    const authLogout = async function (){
        await fetch("../process/pelanggan/logoutauth_pelanggan.php", {
            method : "POST"
        })
    }
    authLogout().then(() => {
        swal("Logout Berhasil","", "success")
        setTimeout(() => {
            location.reload()
        },1500)
    })
}
const pesanError = () => {
    swal("Silahkan Login Untuk Pesan", "", "warning")
}
