import { useState, useEffect } from 'react';
import './App.css';
import { Link } from 'react-router-dom';
import { usePostStore } from './store/postStore';
import { usePostCategories } from './store/postStore';

import LoginForm from './component/LoginForm';

import {Post_Request_Categories,Patch_Request_Categories,DELETE_Request_Categories} from './component/Request';
import Login_API from './component/Login_API'; 
 
function App() {
    const { posts, setPosts } = usePostStore();
    const [SearchTerm, setSearchTerm] = useState("");

    //Pour les categories
    const { categories, setCategories } = usePostCategories();


    //A corriger + tard
    const [recupCategorie, setRecupCategories] = useState("");

 
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
        //Affiche dans la console les éléments passé en paramêtres
        console.log(details);

        if (details.email == adminUser.email && details.password == adminUser.password) {
            //Affiche tous dans le console.log (name, email, password passé en paramêtre)
            //console.log("Logged in")
            setUser({
                name: details.name,
                email: details.email
            });
        } 
        else {
            console.log("Details do not match")
            setError("Details do not match")
        }
    }

    const Logout = () => {
        console.log("Logout");
        //On return rien dans la condition n'est plus rempli et le formulaire réapparais
        setUser({name: "", email: ""})
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

    useEffect(() => {
        fetch('http://127.0.0.1:8000/api/categories/')
            .then((res3) => res3.json())
            .then((res3) => setCategories(res3));
    }, []);

 
    return (
        <div className="App">
            <h1>Les articles</h1> {/*Si les conditions sont remplis cela s'affiche*/}
            {(user.email != "") ? (
                <div className="welcome"> {/*Affichage du nom*/}
                    <h2>Welcome, <span>{user.name}</span></h2>
                    <button onClick={Logout}>Logout</button>
                </div>
            ) : ( //Si on est pas login, on lance le login
                <LoginForm Login={Login} error={error}/>
            )}

            {/*----------------------------------POST/PATCH/DELETE/CATEGORIES-------------------------*/}
            {/*Request()*/} {<Post_Request_Categories />}
            {<Patch_Request_Categories/>}
            {<DELETE_Request_Categories />}


            {/*---------------------------LOGIN NEW FORM---------------------*/}
            {<Login_API />}

            {/*-------------------Pour la fonction rechercher----------------*/}
            <input type="text" placeholder="search"
                //Dès qu'un changement est capté
                onChange={handleSearchTerm}
            />

            {/*--------------Pour le choix de categories-------------*/}
            <div className="CATEGORIES">
                <select className="custom-select"
                    value={recupCategorie} //Recup de la catégorie choisi
                    onChange={(e) => {
                        const selectedCategorie = e.target.value; 
                        //Recup premier donnée passé en paramêtres donc : l'ID
                        setRecupCategories(Array.from(selectedCategorie[0]));
                        //setRecupCategories(selectedCategorie);
                    }}
                >
                    <option value="RESET"></option>
                {categories.length > 0 && categories.map((data) => {
                    return (
                            <option>{data.id} - {data.name}</option>
                    );
                })}
                </select> {/*Affichage de la donnée choisi*/}
                {recupCategorie}
            </div>  {/*-----------------------------------------------------------*/}


            <div className="card">
            {/*---------------Afficher tous les articles--------------------*/}
                {posts.filter((post) => {  //toLowerCase va convertir le texte en minuscule même si on tape en majuscule (davantage de souplesse pour l'utilisateur)
                        return (post.title.toLowerCase().includes(SearchTerm.toLowerCase()) && post.category_id == recupCategorie)//Si des mots qu'on a mis dans la barre de recherche se situe dans les titres des articles
                }).map((post) => {
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