# ERD

![ERD](mermaid-diagram-20200604184703.svg)

```mermaid
erDiagram
        PROFILE }|..|{ BOOK : "own"
        BOOK }|..|{ GENRE : "like"
        BOOK }|..|{ AUTHOR : "write"
        GENRE ||..|| GENRE : "parent of"
```
