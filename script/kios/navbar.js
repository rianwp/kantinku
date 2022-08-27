let toggleState = false

const setSidebar = () => {
    const sidebar = document.getElementById('sidebar')
    if(toggleState){
        sidebar.className = "sidebar bg-light text-black shadow-lg open-sidebar"
    } else{
        sidebar.className = "sidebar bg-light text-black shadow-lg"
    }
}

const toggleSidebar = () => {
    toggleState = !toggleState
    setSidebar()
}
