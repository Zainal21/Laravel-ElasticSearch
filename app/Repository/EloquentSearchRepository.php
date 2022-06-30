<?php
 namespace App\Repository;
 use App\Models\Article;
 use Illuminate\Database\Eloquent\Collection;
 use App\Interface\SearchRepository;

 class EloquentSearchRepository implements SearchRepository
 {
     public function search(string $term): Collection
     {
         return Article::query()
             ->where(fn ($query) => (
                 $query->where('body', 'LIKE', "%{$term}%")
                     ->orWhere('title', 'LIKE', "%{$term}%")
             ))
             ->get();
     }
 } 