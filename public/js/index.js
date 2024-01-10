// const article = document querySelectorAll(".article")

// article.forEach( el => {
//     el.addEventListener("mousemove", e => {

//         let elRect = el.getBoundingClientRect()

//         let x = e.clientX - elRect.x
//         let y = e.clientY - elRect.y

//         let midArticleWidth = elRect.width / 2
//         let midArticleHeight = elRect.height / 2

//         let angleY = (x - midArticleWidth) / 8
//         let angleX = (y - midArticleHeight) / 8

//         el.children[0].style.transform = `rotateX(${angleX}deg) rotateY(${angleY}) scale(1.1)`
//     })
// })