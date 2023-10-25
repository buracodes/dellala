// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: import.meta.env.VITE_FIREBASE_API_KEY,
  authDomain: "delala-400913.firebaseapp.com",
  projectId: "delala-400913",
  storageBucket: "delala-400913.appspot.com",
  messagingSenderId: "291462878777",
  appId: "1:291462878777:web:6eba247519b7cbd33c5fe8"
};

// Initialize Firebase
export const app = initializeApp(firebaseConfig);