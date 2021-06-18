// Post buttons
const postBtns = document.querySelectorAll(".post__delete");

// Comment buttons
const commentBtns = document.querySelectorAll(".comment__delete");
const showCommentsBtns = document.querySelectorAll(".show-comments");

const handleSubmit = (msg, form) => {
    const confirmed = confirm(msg);
    if (confirmed) {
        form.submit();
    }
};

// Event listeners

// post buttons
postBtns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        const form = e.target.closest("form");
        handleSubmit("Are you sure you want to delete the post?", form);
    });
});

// comment buttons
commentBtns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        const form = e.target.closest("form");
        handleSubmit("Are you sure you want to delete your comment?", form);
    });
});

// end event listeners

const handleShowComments = (postId) => {
    const postEl = document.querySelector(`[data-post-id='${postId}']`);
    const commentsEl = postEl.querySelector(".comments-cont .comment-items");

    commentsEl.classList.toggle("show");
};
