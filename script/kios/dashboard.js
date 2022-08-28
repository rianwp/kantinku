const getPesanan = async function (){
    const response = await fetch("../process/kios/getpesananbaru_kios.php", {
        method : "POST",
    })
    const result = await response.json()
    return result 
}

const showPesanan = () => {
    getPesanan().then(response => {
        if(response.length !== 0){
            const table = response.map((detail) => {
                return (`
                    <tr id="col_${detail.id_detailpesanan}">
                        <td class="align-middle fw-normal">${detail.nama_pesanan}</td>
                        <td class="align-middle fw-normal">${detail.keterangan}</td>
                        <td class="align-middle fw-normal">${detail.jumlah}</td>
                        <td class="align-middle fw-normal">Rp${detail.harga_pesanan}</td>
                        <td class="align-middle fw-normal">Rp${detail.jumlah*detail.harga_pesanan}</td>
                        <td class="align-middle fw-normal">${detail.nama_pelanggan}</td>
                        <td class="align-middle fw-normal">${detail.no_meja}</td>
                    </tr>
                `)
            }).join('')
            document.getElementById('tabel-pesanan').innerHTML = table
            document.getElementById('totaljumlah').innerText = response.at(-1).totaljumlah
            document.getElementById('totalharga').innerText = 'Rp' + response.at(-1).totalharga
        }
    })
}
window.onload = (() => {
    showPesanan()
})
setInterval(showPesanan, 1000)