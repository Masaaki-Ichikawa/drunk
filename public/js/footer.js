const pageName = location.pathname
if (pageName == '/dashboard') {
    $('.glass').addClass('active')
} else {
    $('.glass').removeClass('active')
        
}

if ((pageName == '/profile') || (pageName == '/user_mypage')) {
    $('.user').addClass('active')
} else {
    $('.user').removeClass('active')
        
}

if (pageName == '/new_recipe') {
    $('.plus').addClass('active')
} else {
    $('.plus').removeClass('active')
        
}


