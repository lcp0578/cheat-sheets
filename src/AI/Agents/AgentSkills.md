## Agent Skills

- [https://github.com/agentskills/agentskills](https://github.com/agentskills/agentskills) Specification and documentation for Agent Skills
- <https://agentskills.io/home>
- [https://github.com/anthropics/skills](https://github.com/anthropics/skills) Public repository for Agent Skills
- [https://github.com/vercel-labs/skills](https://github.com/vercel-labs/skills) The CLI for the open agent skills ecosystem.
- [https://github.com/openai/skills](https://github.com/openai/skills) Skills Catalog for Codex
- [https://github.com/obra/superpowers](https://github.com/obra/superpowers) An agentic skills framework & software development methodology that works.
- [https://github.com/mattpocock/skills](https://github.com/mattpocock/skills) Agent Skills for real engineers.
- [https://github.com/google/skills](https://github.com/google/skills) Agent Skills for Google products and technologies
- [https://github.com/addyosmani/agent-skills](https://github.com/addyosmani/agent-skills) Production-grade engineering skills for AI coding agents.
- [https://github.com/kepano/obsidian-skills](https://github.com/kepano/obsidian-skills) Agent skills for Obsidian. Teach your agent to use Markdown, Bases, JSON Canvas, and use the CLI.
- [https://github.com/ComposioHQ/awesome-claude-skills](https://github.com/ComposioHQ/awesome-claude-skills) A curated list of awesome Claude Skills, resources, and tools for customizing Claude AI workflows
- [https://github.com/nextlevelbuilder/ui-ux-pro-max-skill](https://github.com/nextlevelbuilder/ui-ux-pro-max-skill) An AI SKILL that provide design intelligence for building professional UI/UX multiple platforms
- [https://github.com/forrestchang/andrej-karpathy-skills](https://github.com/forrestchang/andrej-karpathy-skills) A single CLAUDE.md file to improve Claude Code behavior, derived from Andrej Karpathy's observations on LLM coding pitfalls.
- [https://github.com/Chalarangelo/30-seconds-of-code](https://github.com/Chalarangelo/30-seconds-of-code) Coding articles to level up your development skills

### Skills 介绍

AI 编程中的 **Skills**（技能/规则系统），本质上是在解决一个核心矛盾：**通用大模型能力很强，但不懂你当前项目的“规矩”**。

它把项目特定的知识、规范、架构约定明确地“教会”AI，让它从一个通用助手，变成你项目的专属专家。具体解决了几类问题：

#### 1. 消除“通用味”，统一代码风格

没有 Skills 时，AI 生成的代码风格飘忽不定：一会儿用 `function` 声明，一会儿用箭头函数；缩进、命名方式、导入顺序都可能与项目格格不入。
Skills 把 **ESLint/Prettier 规则、命名规范、文件组织方式** 写进去后，AI 每次输出都会主动遵循，基本不需要你再手动格式化或重命名。

#### 2. 避免重复“交代背景”，降低沟通成本

每个新对话都要重新解释“我们在用 Next.js 14 的 App Router，状态管理用 Zustand，样式用 Tailwind……”非常低效。
Skills 可以预设这些**项目级上下文**（技术栈、库版本、目录结构），AI 默认就带着这些前提去理解你的每一句话，交互效率极大提升。

#### 3. 弥补私有库和特定领域的知识盲区

公司内部的组件库、自定义 Hooks、私有 API 协议，通用 AI 不可能知道。
你可以把**自定义的 API 文档、类型定义、设计模式示例**定义为 Skills。之后让它写调用代码时，它会准确使用内部方法，而不是凭空猜测、生成无法运行的 API。

#### 4. 强制遵循架构约束和最佳实践

“数据请求必须统一走 services 层，不能直接在组件里调；React 组件优先用 Server Component；错误处理必须统一用 ErrorBoundary……”这类更深层的**架构决策**，仅靠代码示例很难让 AI 长期牢记。
Skills 能把这类“心法”固化为硬约束，让 AI 不会为了功能而破坏整体架构，守住项目质量底线。

#### 5. 保障团队协作的输出一致性

多人使用 AI 辅助编码时，如果各聊各的，很容易出现：同一类功能，A 让 AI 用方案 X 实现，B 让 AI 用方案 Y 实现，代码库变得四分五裂。
共享一套项目 Skills 后，所有人获得的建议都基于同一套规则，**大幅减少代码审查时的理解成本和修正工作量**。
