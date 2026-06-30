## Superpowers: An agentic skills framework & software development methodology that works.

- https://github.com/obra/superpowers
- Superpowers is a complete software development workflow for your coding agents, built on top of a set of composable "skills" and some initial instructions that make sure your agent uses them.
- [https://github.com/iamgio/quarkdown](https://github.com/iamgio/quarkdown) Markdown with superpowers: from ideas to papers, presentations, websites, books, and knowledge bases.
### Superpowers是确保工程按图纸施工、保质保量的“执行教练”。
- 它内置了 **20+个可组合的技能（Skills）**，强制AI遵循软件工程的最佳实践。这些技能大致可分为几类：

#### 🧠 规划与协作类

- **`brainstorming` (头脑风暴)**：最重要的入口技能。在写任何代码前，强制AI像产品经理一样，通过提问澄清需求、分析方案，未获批准绝不动手。
- **`writing-plans` (编写计划)**：将设计拆解为 **2-5分钟** 就能完成的原子化任务，每个任务包含精确的文件路径、完整的代码（禁止占位符）和验证命令。
- **`using-git-worktrees` (Git工作树)**：为每次开发创建独立的Git工作树，实现开发环境与主分支的物理隔离，确保主分支始终稳定。

#### 🤖 执行与质量类

- **`subagent-driven-development` (子代理驱动开发)**：核心技能。为`writing-plans`生成的每个任务，都派发一个全新的、上下文独立的子代理去执行。这能有效避免长上下文带来的幻觉和前后矛盾。
- **`dispatching-parallel-agents` (并行子代理)**：当有多个互不依赖的任务时，可同时派发多个子代理并行处理，大幅提升效率。
- **`requesting-code-review` (代码审查)**：AI会自动获取代码变更（diff），按严重程度报告问题，关键问题会阻止流程继续。
- **`test-driven-development` (测试驱动开发)**：强制AI遵循“先写测试，再写实现”的TDD流程。

#### 🔧 调试与元技能类

- **`systematic-debugging` (系统化调试)**：提供结构化的bug排查流程，避免随机修改-。
- **`writing-skills` (编写新技能)**：这是一个“元技能”。它允许你教AI按照规范创建新的`SKILL.md`文件，将团队特有的规范或最佳实践固化为新的技能。