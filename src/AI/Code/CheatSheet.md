## AI辅助编程工具速查手册

### 一、Claude Code 相关

#### 1.启动方式

##### 1.1 基本启动

- 在当前目录启动交互界面

  ```shell
  claude
  ```

- 指定目录启动

  ```shell
  claude /path/to/project
  ```

- 带初始问题启动

  ```shell
  claude "帮我分析这个项目结构"
  ```

- 一次性执行并退出（脚本模式）

  ```shell
  claude -p "解释这个函数"
  ```

- 继续上次对话

  ```shell
  claude -c
  ```

- 查看版本

  ```shell
  claude --version
  ```

##### 1.2 管道输入

```shell
cat file.py | claude -p "优化这段代码"
```

##### 1.3 启动参数说明

| 参数                 | 说明                         |
| :------------------- | :--------------------------- |
| `-c` 或 `--continue` | 继续当前目录的上一次聊天     |
| `--resume`           | 恢复上次会话                 |
| `-p`                 | 一次性执行并退出（打印模式） |
| `--plan`             | 以计划模式启动（只读分析）   |
| `--architect`        | 大型项目架构模式             |

##### 1.4 界面三件套

- 输入区
  - 最底部`>`符号后面打字，回车发送。Shift+Enter换行不发送。
- 输出区
  - 回复、代码、工具调用等结果。
- Status Line
  - 底部一行仪表盘:模型名、Effort、上下文用量%、花费。默认为空，用`/statusline`配置。

#### 2 核心操作

##### 2.1 输入前缀

| 前缀                 | 作用                         |  示例 |
| :------------------- | :--------------------------- | :--------------|
|`!`|前缀直接执行终端命令，输出进入上下文|`!git log --oneline -5`|
|`@`|读取文件内容到对话中|`@src/index.js`这段有什么问题?|
|`#`|把文件添加到上下文(随时参考，不立即提问)|`#config.yaml`|
|`/`|斜杠命令菜单(见下方)| `/model sonnet`|
|`&`|后台执行任务，不阻塞当前对话|&跑一下测试套件|
|`\+Enter`|换行不发送，写多行内容|长需求描述一次写完|

##### 2.2 斜杠命令

| 命令                 | 说明                         |
| :------------------- | :--------------------------- |
|`/model` | 切换模型。也可`/model sonnet` 直接切 |
|`/compact` | 压缩上下文，把早期对话总结成摘要 |
|`/clear` | 清空对话从头开始(不可逆) |
|`/voice` | 语音输入，按住空格说话松开发送 |
|`/add-dir` | 把额外目录加入工作范围 |
|`/statusline` | 配置底部状态栏显示内容 |
|`/effort` | 调整思考深度:low/medium/high/max |
|`/plan` | 进入只读Plan模式，先看方案再动手 |
|`/rewind` | 回退到任意一轮对话(后悔药) |
|`/config` | 打开设置面板 |
|`/copy` | 复制最近一条回复到剪贴板  |
|`/name` | 给当前会话起名，方便`--resume`查找 |

- Effort四档说明
  - `low`:  省油模式。简单任务直接给答案。
  - `medium`: 默认档。大多数场景用这个。
  - `high`: 深度思考。复杂逻辑、架构问题。
  - `max`:  全力输出。仅Opus可用。

#### 3 常见输出说明

##### 3.1 🎬 正在处理中 (Spinner Verbs)

- 这些是 Claude Code “思考”时在终端里跳出的动态词，通常以 `-ing` 结尾。它让等待过程不那么无聊，也暗示了AI正在做哪方面的工作。
  - **Mulling / Pondering / Contemplating**: 反复琢磨、权衡多种方案。
  - **Cogitating / Cerebrating / Ruminating**: 深度分析、进行复杂的逻辑推演。
  - **Synthesizing / Inferring**: 综合分析信息或从现有代码推断意图。
  - **Marinating / Billowing**: 深度预处理上下文，像腌肉一样“浸泡”在项目文件里。
  - **Metamorphosing / Orchestrating**: 大规模重构代码结构，或协调多个模块。
  - **Architecting / Envisioning**: 设计项目的宏观骨架或整体蓝图。
  - **Spelunking**: 像洞穴探险一样深入挖掘项目目录和文件。
  - **Grooving**: 适应你的代码风格和节奏，渐入佳境。
  - **Linting / Finagling / Moseying**: 进行代码检查、微调、或悠闲漫步般处理任务。
  - **Precipitating / Finalizing**: 将复杂逻辑最终“沉淀”为具体代码文件，做收尾工作。
  - **Vibing / Noodling / Jazzercising**: 进行创意的、带点即兴发挥的编码，注入活力。

##### 3.2 📋 请求确认 (Permission Prompts)

- 当AI需要执行可能影响你系统的操作时，会暂停并等待你的批准-。这是为了让你保持对代码的完全控制。
  - **Do you want to proceed?**: 询问是否执行你刚才下达的指令。
  - **Allow file edits?**: 请求修改某个文件的权限。
  - **Allow execution of [command]?**: 请求在终端执行特定命令（如 `npm install`）的权限。
  - **Allow this tool call?**: 请求调用某个MCP（Model Context Protocol）工具或技能的权限。

##### 3.3 ⚙️ 状态与信息 (Status & Info)

- 这些是Claude Code关于自身状态或执行结果的报告。
  - **Context limit exceeded. Compacting...**: 对话上下文过长，正通过`/compact`命令自动压缩历史记录。
  - **Task completed successfully.**: 任务已成功完成。
  - **No changes made. Exiting...**: 在计划模式（Plan Mode）下完成分析，但未执行任何修改。
  - **Using model: claude-sonnet-4-6**: 告诉你当前正在使用的AI模型。
  - **Token usage: ...**: 显示当前会话消耗的Token数量（计费单位），可用`/cost`命令查询。
  - **Working... / Processing...**: 最通用的提示，表示AI正在工作。

##### 3.4 ❌ 错误与警告 (Errors & Warnings)

- 当出现问题时，Claude Code会给出相应的错误信息。
  - **API key not found. Please set...**: API Key未找到，需设置环境变量`ANTHROPIC_API_KEY`或通过`/config`命令配置。
  - **Insufficient funds or quota exceeded.**: API账户余额不足或配额已用完。
  - **Connection error. Please check your network and try again.**: 网络连接失败。
  - **Command not found: [command]**: 输入的斜杠命令不存在，可用`/help`查看列表。
  - **Failed to write file. Permission denied.**: 没有写入目标文件的权限。
  - **Exit Code 2**: 这是一个关键错误，表示遇到了“阻塞性错误”（如一个pre-tool-use hook失败），Claude Code会立即停止当前操作-。
  - **Other Non-Zero Exit Codes**: 表示发生了“非阻塞性错误”，Claude Code会尝试继续，但可能结果不符合预期-。

##### 3.5 ✍️ 如何让Claude Code默认说中文？

- 如果希望Claude Code的提示信息默认使用中文，可以在项目根目录的 `CLAUDE.md` 文件中，添加一行明确的指令：`所有回复和提示请使用中文`。这样，AI在处理该项目的所有任务时，都会自动遵循此语言规则。

#### 4 权限三档：定义操作的“安全红线”

- 权限三档是 Claude Code 权限系统的基础，它将所有操作划分为三种明确的处理方式：
  - **Allow (允许)**：操作被预先授权，系统会自动放行，完全无需打扰你。这适合配置给 `git status`、`npm run build` 等安全且高频的指令。
  - **Deny (拒绝)**：**拥有最高优先级**，一旦命中，操作会被直接阻止，且不会弹出任何提示。这条铁律专门用于防范重大风险，例如 `git push --force`、`rm -rf` 或包含 `curl`/`wget` 的未知网络请求。
  - **Ask (询问)**：这是系统的默认行为，AI 无法自行决断，必须弹窗并“挂起”任务，直到你手动选择 `Allow` 或 `Deny`。
- 这三档构成了一个严格的**规则引擎**，其优先级固定为 **Deny > Ask > Allow**，以保证 Deny 规则无法被任何 Allow 规则覆盖。权限检查遵循“首个匹配获胜”原则：
  - 1. **检查 Deny 规则列表** → 匹配到即阻止。
  - 1. **检查 Ask 规则列表** → 匹配到即询问用户。
  - 1. **检查 Allow 规则列表** → 匹配到即自动放行。
  - 1. **都不匹配** → 进入默认逻辑，通常表现为 Ask 行为。

#### 5 Plan 模式：先规划，再执行

##### 5.1 ✍️ 标准工作流程

- Plan 模式遵循一个线性的“先谋后动”流程：
  - 1. **分析与规划**：AI 进入只读模式-，通过浏览文件（Read）、搜索代码（Grep）等工具分析项目，并生成包含步骤、文件、函数等内容的详细执行计划。
  - 1. **审查与协作**：计划生成后，AI 会“挂起”等待你的审查。你可以直接批准，或通过对话交互来修改计划。（此时按 `Ctrl+G`，还可以在默认文本编辑器中直接编辑计划文本，实现更高效的控制）
  - 1. **执行与收尾**：计划获得你的批准后，AI 才会退出 Plan 模式，开始实际的代码编写工作。

##### 5.2 ⚙️ 启用与配置

- 有多种方式可以进入 Plan 模式，你可以根据场景选择最方便的：
  - **会话内切换**：直接按 `Shift+Tab` 键，在模式间循环切换，直到终端底部出现 `⏸ plan mode on` 的提示。
  - **启动时指定**：在终端中使用命令 `claude --permission-mode plan` 启动。
  - **设为默认值**：在 `.claude/settings.json` 文件中添加配置 `{"permissions": {"defaultMode": "plan"}}`，使其成为所有新会话的默认模式。
  - **创建别名**：在你的 shell 配置文件（如 `.zshrc`）中添加 `alias ccp='claude --permission-mode plan'`，之后只需输入 `ccp` 即可快速启动。
  - **在 Plan 模式中无头运行**：例如 `claude -p "你的问题" --permission-mode plan`，适合需要快速获得结构化方案而不进入完整交互会话的场景。
  - **查看plan内容**，计划存在`~/.claude/plans/`，可查看修改。

##### 5.3 🚀 进阶：Ultraplan

- 如果你需要更强大的审查能力，可以了解“Ultraplan”工作流。

#### 6 三个模型

##### 6.1 Opus 4.6/4.7

- 最强大脑
  - 复杂推理、长代码、架构设计。慢，吃配额。
  - opusplan可以Opus规划+Sonnet执行，省配额。
   Ctrl+V 粘贴图片到对话(截图分析)Meta+P 快速切模型(Mac:Option+P)ultrathink 在消息中说，临时切high effort

##### 6.2 Sonnet 4.6

- 默认/性价比
  - 日常写码、改bug、回答问题。速度比Opus快不少，大多数场景够用。

##### 6.3 Haiku 4.5

- 最快最便宜
  - 重命名文件、格式转换、简单问答。不需要动脑子的活交给它。

#### 7 rewind后悔药

- `Esc` `Esc` 或`/rewind`打开历史列表
- 选择回退到哪一步，代码和对话都恢复
- 也可以只恢复对话、保留代码(改对了但说错了)
- 只能撤回文件修改，git push等对外操作不可逆
- 仅当前会话有效，关掉Claude Code历史就没了
- 大胆让Claude试一改坏了两下`Esc`回去

#### 8 会话管理

- 继续对话
  - `claude --continue` 继续最近一次对话。`claude --resume` 从历史列表里
    挑。
- 压缩Compact
  - 上下文到80%+会自动压缩。也可`/compact` 手动触发。早期细节丢失但核心保留。
- 上下文陷阱
  - 1M窗口听着爽，但每轮把全部上下文一起发。对话越长每轮消耗越多，配额可能很快用光。盯住Status Line的百分比。

### 二、智谱Coding Tool Helper

- 如果你需要重新配置 API Key 或切换工具，可再次运行：

  ```shell
  npx @z_ai/coding-helper
  ```

- 按照交互式向导完成语言选择、套餐选择、API Key 输入和工具选择即可。


### 三、为Claude Code配置第三方模型

#### 3.1 配置文件

- 位置：`~/.claude/settings.json`

#### 3.2 配置智谱GLM模型

```json
{
  "env": {
    "ANTHROPIC_AUTH_TOKEN": "xxxxxxxxxxxxxxxxxxxxxxxxx",
    "ANTHROPIC_BASE_URL": "https://open.bigmodel.cn/api/anthropic",
    "API_TIMEOUT_MS": "3000000",
    "CLAUDE_CODE_DISABLE_NONESSENTIAL_TRAFFIC": "1",
    "ANTHROPIC_DEFAULT_HAIKU_MODEL": "glm-4.5-air",
    "ANTHROPIC_DEFAULT_SONNET_MODEL": "glm-4.7",
    "ANTHROPIC_DEFAULT_OPUS_MODEL": "glm-5.1"
  },
  "model": "opus"
}
```

#### 3.3 配置DeepSeek V4模型

```json
{
  "env": {
    "ANTHROPIC_AUTH_TOKEN": "xxxxxxxxxxxxxxxxxxxxxxxxx",
    "ANTHROPIC_BASE_URL": "https://api.deepseek.com/anthropic",
    "API_TIMEOUT_MS": "3000000",
    "CLAUDE_CODE_DISABLE_NONESSENTIAL_TRAFFIC": "1",
    "ANTHROPIC_DEFAULT_HAIKU_MODEL": "deepseek-v4-flash",
    "ANTHROPIC_DEFAULT_SONNET_MODEL": "deepseek-v4-pro",
    "ANTHROPIC_DEFAULT_OPUS_MODEL": "deepseek-v4-pro"
  },
  "model": "opus"
}
```

