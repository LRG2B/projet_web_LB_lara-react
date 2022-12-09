import { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import { usePostStore } from '../store/postStore';

import Patch_Request_Articles from '../component/Articles_Request';

function Article() {
	let { id } = useParams();
	const [post, setPost] = useState(null);
	const { posts } = usePostStore();

	useEffect(() => {
		if (!id || !posts) return;
		setPost(posts.find((item) => Number(item.id) === Number(id)));
	}, [id, posts]);

	return (
		<div>
			{post && (
				<>
					<h2>{post.title}</h2>
					<p>{post.body}</p>
					<Link to={`/`}>retour à la liste</Link>
				</>
			)}

			<Patch_Request_Articles />
		</div>
	);
}

export default Article;
