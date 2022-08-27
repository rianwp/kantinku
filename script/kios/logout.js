const setLogout = () => {
    const authLogout = async function (){
        await fetch("../process/kios/logoutauth_kios.php", {
            method : "POST"
        })
    }
    authLogout().then(() => {
        swal("Logout Berhasil","", "success")
        setTimeout(() => {
            window.location.href = "/loginkios"
        },1500)
    })
}

