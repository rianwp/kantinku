const editFoto = (id_menu) => {
    const foto = document.getElementById('foto-'+id_menu).files

    const editFotoData = new FormData
    editFotoData.append("foto", foto[0])
    editFotoData.append("id_menu", id_menu)

    const setFoto = async function (){
        const response = await fetch("../process/kios/editfotomenu_kios.php", {
            method : "POST",
            body : editFotoData
        })
        const result = await response.json()
        return result 
    }
    setFoto().then(response => {
        if(response.success){
            swal("Edit Foto Berhasil", response.msg, response.type)
            setTimeout(() => {
                location.reload()
            },1500)
        } else{
            swal("Edit Foto Gagal", response.msg, response.type)
        }
    })
}
const editMenu = (id_menu) => {
    const nama = document.getElementById('nama-'+ id_menu).value
    const harga = document.getElementById('harga-'+id_menu).value

    const editMenuData = new FormData
    editMenuData.append("nama", nama)
    editMenuData.append("harga", harga)
    editMenuData.append("id_menu", id_menu)
    

    const setMenu = async function (){
        const response = await fetch("../process/kios/editmenu_kios.php", {
            method : "POST",
            body : editMenuData
        })
        const result = await response.json()
        return result 
    }
    setMenu().then(response => {
        if(response.success){
            swal("Edit Menu Berhasil", response.msg, response.type)
            setTimeout(() => {
                location.reload()
            },1500)
        } else{
            swal("Edit Menu Gagal", response.msg, response.type)
        }
    })
}

const tambahMenu = () => {
    let msgErrorNama = document.getElementById('nama-error')
    let msgErrorHarga = document.getElementById('harga-error')
    let msgErrorFoto = document.getElementById('foto-error')
    
    const nama = document.getElementById('tambahnama').value
    const harga = document.getElementById('tambahharga').value
    const foto = document.getElementById('tambahfoto').files

    if(nama != "" && harga != "" && parseInt(harga) > 0 && foto.length > 0){
        msgErrorNama.innerText = ""
        msgErrorHarga.innerText = ""
        msgErrorFoto.innerText = ""
        
        const tambahMenuData = new FormData
        tambahMenuData.append("nama", nama)
        tambahMenuData.append("harga", harga)
        tambahMenuData.append("foto", foto[0])
        
        const setMenu = async function (){
            const response = await fetch("../process/kios/tambahmenu_kios.php", {
                method : "POST",
                body : tambahMenuData
            })
            const result = await response.json()
            return result 
        }
        setMenu().then(response => {
            if(response.success){
                swal("Menu Berhasil Ditambahkan", response.msg, response.type)
                setTimeout(() => {
                    location.reload()
                },1500)
            } else{
                swal("Menu Gagal Ditambahkan", response.msg, response.type)
            }
        })
    } else{
        if (harga == "" || parseInt(harga) <= 0){
            msgErrorHarga.innerText = "Harga tidak boleh kosong dan kurang dari 0"
        } else{
            msgErrorHarga.innerText = ""
        }
        if (nama == ""){
            msgErrorNama.innerText = "Nama menu tidak boleh kosong"
        } else{
            msgErrorNama.innerText = ""
        }
        if(foto.length <= 0){
            msgErrorFoto.innerText = "Foto harus diisi"
        } else{
            msgErrorFoto.innerText = ""
        }
    }
    
}

const hapusMenu = (id_menu) => {
    const hapusMenuData = new FormData
    hapusMenuData.append("id_menu", id_menu)

    const setHapus= async function (){
        await fetch("../process/kios/hapusmenu_kios.php", {
            method : "POST",
            body : hapusMenuData
        })
    }
    setHapus().then(() => {
        swal("Menu Berhasil Dihapus","", "success")
        setTimeout(() => {
            location.reload()
        },1500)
    })
}