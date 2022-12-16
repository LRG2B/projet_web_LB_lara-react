import create from 'zustand';

export const usePostStore = create((set) => ({
	posts: [],
	setPosts: (posts) => set((state) => ({ posts: posts })),
}));

export const usePostCategories = create((set) => ({
	categories: [],
	setCategories: (categories) => set((state) => ({categories: categories })),
}))
