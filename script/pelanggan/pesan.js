let dataMenuRecap = []
let totalHarga = 0
let count = 0
let dataPesanRecap = {}
let innerTotalHarga = document.getElementById('total_harga')
let msgErrorJumlah = document.getElementById('jumlah-error')
let msgErrorPilih = document.getElementById('pilih-error')
let msgErrorPesanan = document.getElementById('pesanan-error')
let msgErrorNoMeja = document.getElementById('no_meja-error')

const changeMenu = (id_menu, nama_menu, harga_menu, id_kios) => {
    document.getElementById('id_menu').value = id_menu;
    document.getElementById('id_kios').value = id_kios;
    document.getElementById('nama_menu').value = nama_menu;
    document.getElementById('harga_menu').value = harga_menu;

}

const getPesanan = () => {
    const checkJumlah = document.getElementById('jumlah').value
    const checkPilih = document.getElementById('id_menu').value

    if (checkJumlah != "" && parseInt(checkJumlah) > 0 && checkPilih != ""){
        msgErrorJumlah.innerText = ""
        msgErrorPilih.innerText = ""
        msgErrorPesanan.innerText = ""

        const dataMenu = {}
        count += 1
        dataMenu.id = count
        dataMenu.id_menu = parseInt(document.getElementById('id_menu').value)
        dataMenu.id_kios = parseInt(document.getElementById('id_kios').value)
        dataMenu.nama_menu = document.getElementById('nama_menu').value
        dataMenu.harga_menu = parseInt(document.getElementById('harga_menu').value)
        dataMenu.jumlah = parseInt(document.getElementById('jumlah').value)
        dataMenu.keterangan = document.getElementById('keterangan').value
        dataMenuRecap.push(dataMenu)

        document.getElementById('tabel-pesanan').innerHTML += (`
            <tr id="col_${dataMenu.id}">
                <td class="align-middle">${dataMenu.nama_menu}</td>
                <td class="align-middle">${dataMenu.jumlah}</td>
                <td class="align-middle">Rp${dataMenu.harga_menu}</td>
                <td class="align-middle">Rp${dataMenu.jumlah*dataMenu.harga_menu}</td>
                <td class="align-middle"><button onclick="deletePesanan('col_${dataMenu.id}')" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button></td>
            </tr>
        `)
        
        totalHarga += (dataMenu.harga_menu*dataMenu.jumlah)
        innerTotalHarga.innerText = 'Rp' + totalHarga

    } else{
        if (checkJumlah == "" || parseInt(checkJumlah) <= 0){
            msgErrorJumlah.innerText = "Jumlah tidak boleh kosong dan kurang dari 0"
        } else{
            msgErrorJumlah.innerText = ""
        }
        if (checkPilih == ""){
            msgErrorPilih.innerText = "Silahkan pilih salah satu menu"
        } else{
            msgErrorPilih.innerText = ""
        }
    }
}

const deletePesanan = id_delete => {
    document.getElementById(id_delete).remove()
    const id = parseInt(id_delete.substr(4))
    const key = dataMenuRecap.findIndex(dataMenu => dataMenu.id === id)
    totalHarga -= (dataMenuRecap[key].harga_menu*dataMenuRecap[key].jumlah)
    dataMenuRecap.splice(key, 1)
    innerTotalHarga.innerText = 'Rp' + totalHarga
}

const getPesananRecap = () => {
    const noMeja = document.getElementById('no_meja').value

    if (parseInt(noMeja) > 0 && noMeja != "" && dataMenuRecap.length > 0){
        msgErrorPesanan.innerText = ""
        msgErrorNoMeja.innerText = ""
        dataPesanRecap.detail_pesanan = dataMenuRecap
        dataPesanRecap.no_meja = parseInt(noMeja)
        dataPesanRecap.total_harga = totalHarga

        //fetch
        const dataPesanJSON = new URLSearchParams
        dataPesanJSON.append("pesanan", JSON.stringify(dataPesanRecap))

        const sendData = async function (){
            const response = await fetch("../process/pelanggan/insertpesanan_pelanggan.php", {
                method : "POST",
                body : dataPesanJSON
            })
            const result = await response.json()
            return result 
        }
        sendData().then(response => {
            swal("Pesanan Berhasil Dikirim", response.msg, response.type)
        })
        
        //reset
        document.getElementById('tabel-pesanan').innerHTML = ""
        totalHarga = 0
        count = 0
        dataMenuRecap = []
        dataPesanRecap = {}
        innerTotalHarga.innerText = 'Rp' + totalHarga

    } else{
        if (parseInt(noMeja) <=0 || noMeja == ""){
            msgErrorNoMeja.innerText = "No Meja tidak boleh kosong dan isikan no meja dengan sesuai"
        } else{
            msgErrorNoMeja.innerText = ""
        }
        if (dataMenuRecap.length <= 0){
            msgErrorPesanan.innerText = "Pesanan anda masih kosong"
        } else{
            msgErrorPesanan.innerText = ""
        }
    }
}