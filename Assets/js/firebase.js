// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.9.0/firebase-app.js";
import {
  getDatabase,
  ref,
  set,
  onValue,
  push,
} from "https://www.gstatic.com/firebasejs/10.9.0/firebase-database.js";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyC4mK9JdDdJUjUQtkm3kLWIbG7gIBntArs",
  authDomain: "hocvu-5dedf.firebaseapp.com",
  projectId: "hocvu-5dedf",
  storageBucket: "hocvu-5dedf.appspot.com",
  messagingSenderId: "109221762575",
  appId: "1:109221762575:web:c4d9ce59b68ea75906b57a",
  databaseURL:
    "https://hocvu-5dedf-default-rtdb.asia-southeast1.firebasedatabase.app",
};

// Initialize Firebase
// Initialize Firebase
const app = initializeApp(firebaseConfig);

// Initialize Realtime Database and get a reference to the service
const database = getDatabase(app);
console.log({
  database,
  app,
});

const btn_comment = document.getElementById("btn_comment");
const content = document.getElementById("textAreaContent");

const ma_cuocthaoluan = btn_comment.getAttribute("data-ma_cuocthaoluan");
const ma_nguoidung = btn_comment.getAttribute("data-ma_nguoidung");

function writeUserData(id_post, content, ma_nguoidung) {
  // set(ref(database, "comment-" + id_post + "/" + ma_nguoidung), {
  //   ma_nguoidung: ma_nguoidung,
  //   content: content,
  //   createdAt: Date.now(),
  // });
  push(ref(database, "comment-" + ma_cuocthaoluan), {
    ma_nguoidung: ma_nguoidung,
    content: content,
    createdAt: Date.now(),
  });
}
//  writeUserData(1, 'hello', 'content');
const starCountRef = ref(database, "comment-" + ma_cuocthaoluan);
const ElmComments = document.getElementById("comments");
onValue(starCountRef, (snapshot) => {
  const data = snapshot.val();
  let html = "";
  Object.keys(data).forEach((messageKey) => {
    const item = data[messageKey];
    html += `
    <div class="d-flex flex-start">
        <img class="rounded-circle shadow-1-strong me-3" src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" alt="avatar" width="65" height="65" />
        <div class="flex-grow-1 flex-shrink-1">
            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-1">
                        ${item.ma_nguoidung}<span class="small">- ${new Date(
      item.createdAt
    ).toISOString()}</span>
                    </p>
                    <a href="#!"><i class="fas fa-reply fa-xs"></i><span class="small">
                            reply</span></a>
                </div>
                <p class="small mb-0">
                    ${item?.content}
                </p>
            </div>
  
            
        </div>
    </div>
    `;
  });
  ElmComments.innerHTML = html;
});

btn_comment.addEventListener("click", () => {
  writeUserData(ma_cuocthaoluan, content.value, ma_nguoidung);
});
