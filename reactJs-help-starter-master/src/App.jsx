import { useState, useEffect } from 'react';
import './App.css';
import { Link } from 'react-router-dom';
import { usePostStore } from './store/postStore';

import LoginForm from './component/LoginForm';
 
 
function App() {
    const { posts, setPosts } = usePostStore();
    const [SearchTerm, setSearchTerm] = useState("");
 
//---------------------------------Login/Logout
    const adminUser = {
        email: "admin@admin.com",
        password: "admin123"
    }

    //Pour recup les infos passés lors du login
    const [user, setUser] = useState({name: "", email:""});
    const [error, setError] = useState("");

    //Fonction qu'on va appeler quand on va essayer de se login in
    const Login = details => {
        console.log(details);
    }

    const Logout = () => {
        console.log("Logout");
    }
//--------------------------------------------------------

    //Pour filter les resultats 
    const handleSearchTerm = (e) => {
        //value va intercepté la donnée
        let value = e.target.value;
        //et la mettre dans le string
        setSearchTerm(value);
    };
 
    useEffect(() => {
        fetch('http://127.0.0.1:8000/api/articles/')
            .then((res) => res.json())
            .then((res) => setPosts(res)); //Avant c'était setPosts(res.data)
    }, []);
 
    return (
        <div className="App">
            <h1>Les articles</h1>
            {(user.email != "") ? (
                <div className="welcome"> {/*Affichage du nom*/}
                    <h2>Welcome, <span>{user.name}</span></h2>
                    <button>Logout</button>
                </div>
            ) : ( //Si on est pas login, on lance le login
                <LoginForm Login={Login} error={error}/>
            )}

            {/*Pour la fonction rechercher*/}
            <input type="text" placeholder="search"
                //Dès qu'un changement est capté
                onChange={handleSearchTerm}
            />
 
            <div className="card">
            {/*Afficher tous les articles*/}
                {posts.filter((post) => {
                        return post.title.toLowerCase().includes(SearchTerm.toLowerCase()) //Si des mots qu'on a mis dans la barre de recherche se situe dans les titres des articles
                }).map((post) => {                                                        //toLowerCase va convertir le texte en minuscule même si on tape en majuscule (davantage de souplesse pour l'utilisateur)
                        return (
                            <div key={post.id}>
                                {/*Consulter directement l'article*/}
                                <Link to={`/articles/${post.id}`}><h2>{post.title}</h2></Link>
                                <p>{post.body}</p>
                            </div>
                        );
                    })}
            </div>
        </div>
    );
}
 
export default App;
 
 
 
 

