## rm 把文件移除git index
- 仅移除索引

		git rm --cached [file]
        // If you omit the --cached option, it will also delete it from the working tree.
        git rm --cached -r [directory]