const pathname = window.location.pathname;
const pagename = pathname.split("/")[3]

if (pagename === 'home.php') {
    document.querySelector('.home').classList.add("active");
}
if (pagename === 'about.php') {
    document.querySelector('.about').classList.add("active");
}
if (pagename === 'course.php') {
    document.querySelector('.course').classList.add("active");
}
if (pagename === 'login.php') {
    document.querySelector('.login').classList.add("active");
}
if (pagename === 'register.php') {
    document.querySelector('.register').classList.add("active");
}
if (pagename === 'contact.php') {
    document.querySelector('.contact').classList.add("active");
}