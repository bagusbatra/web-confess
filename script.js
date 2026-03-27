// =======================
// LOVE PARTICLE
// =======================

function createLove(){

    const love = document.createElement("div")

    love.classList.add("love")

    love.innerHTML = "❤"

    love.style.left = Math.random()*100 + "vw"

    love.style.fontSize = (Math.random()*25 + 55) + "px"

    love.style.animationDuration = (Math.random()*4 + 6) + "s"

    document.querySelector(".love-container").appendChild(love)

    setTimeout(()=>{
    love.remove()
    },10000)
}
setInterval(createLove,400)



// =======================
// FOTO JATUH SEPERTI DAUN
// =======================

function createLeaf(){

    if(images.length === 0) return

    const leaf = document.createElement("img")

    leaf.src = images[Math.floor(Math.random()*images.length)]

    leaf.classList.add("leaf")

    leaf.style.left = Math.random()*100 + "vw"

    leaf.style.width = (Math.random()*100 + 40) + "px"

    leaf.style.animationDuration = (Math.random()*5 + 8) + "s"

    document.querySelector(".leaf-container").appendChild(leaf)

    setTimeout(()=>{
        leaf.remove()
    },13000)

}
setInterval(createLeaf,900)


// =======================
// TOMBOL YES
// =======================



// =======================
// TOMBOL YES
// =======================

const btnNo = document.getElementById("no");

btnNo.addEventListener("click", function() {

    // jalankan animasi jatuh
    btnNo.classList.remove("animate__hinge");
    void btnNo.offsetWidth; 
    btnNo.classList.add("animate__animated", "animate__hinge");

    // setelah animasi selesai tombol disembunyikan
    setTimeout(() => {
        btnNo.style.display = "none";
    }, 2000); // durasi animasi hinge sekitar 2 detik

    // tombol no kemudian muncul lagi
    setTimeout(() => {
        btnNo.style.display = "inline-block";
        btnNo.classList.remove("animate__animated", "animate__hinge");
    }, 10000);

});



// NEXT

const pages = document.querySelectorAll(".page")
const nextButtons = document.querySelectorAll(".next")

let currentPage = 0

nextButtons.forEach(button => {

    button.addEventListener("click", () => {

        pages[currentPage].classList.remove("active")

        currentPage++

        if(currentPage < pages.length){
            pages[currentPage].classList.add("active")
        }
    })
})




// MUSIK

const music = document.getElementById("bg-music")

music.volume = 0

document.addEventListener("click", () => {

    music.play()

    let fade = setInterval(() => {

        if(music.volume < 0.5){
            music.volume += 0.05
            }
            else{
                clearInterval(fade)
        }
    },200)
},{once:true})


