import React, {useState} from 'react'

function CategorieChoice() {

    const [categories, setCategories] = ("")


        fetch('http://127.0.0.1:8000/api/categories/')
            .then((data) => data.json())
            .then((data) => setCategories(data)); //Avant c'était setPosts(res.data)


    return(
            <div className="CategorieChoice">
                <select id="CategorieSelect">
                    <optgroup label="categories">
                        <option> TEST </option>
                        <option> TEST 2</option>
                    </optgroup>
                </select>
                <script>
                    console.log(categories)
                </script>

            </div>
    )
}

export default CategorieChoice;