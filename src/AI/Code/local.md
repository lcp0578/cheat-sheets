## 本地AI辅助编程方案

- 方案一：Codex + Superpowers + 本地模型（最严格的工程规范）

  - 定位：将 Codex 作为执行引擎，加载 Superpowers 技能包，实现“先规划、再执行、后审查”的工程级 AI 编程。

  - 优势：

    - Superpowers 强制 TDD、需求澄清、代码审查，产出质量高

    - 模型可本地化（Ollama + Qwen/DeepSeek），数据安全

    - Codex 是 OpenAI 官方 CLI，稳定且持续更新

- 方案二：Goose + 本地模型（最自由的自主 Agent）

  - 定位：Goose 是一个开源的 AI 智能体框架，可以自主规划并执行多步骤任务（读写文件、执行命令、调用 API）。

  - 优势：

    - 完全本地化，数据不出电脑

    - 可接入任意模型（Ollama、OpenAI、Claude API）

    - 支持 MCP 协议，扩展性强

- 方案三：Qwen Code CLI + 本地/云端模型（阿里官方）

  - 定位：阿里官方 CLI，支持四种执行模式，可接入本地 Ollama 或云端 Qwen 模型。

  - 优势：

    - 官方工具，体验完善

    - 可本地部署（需配置环境变量）

    - 支持子智能体、MCP 协议

### 本地模型

<table>
	<tr>
		<th> 模型系列 </th>
		<th> 具体版本 </th>
		<th> 发布时间 </th>
		<th> 总参数量 </th>
		<th> 激活参数量 </th>
		<th> 架构类型 </th>
		<th> 上下文长度 </th>
		<th> SWE-Bench Verified (%) </th>
		<th> HumanEval (%) </th>
		<th> Aider (%) </th>
		<th> 开源协议 </th>
		<th> 核心特点与备注 </th>
	</tr>
	<tr>
		<td rowspan="4"> Qwen-Coder </td>
		<td> Qwen3-Coder-480B-A35B-Instruct </td>
		<td> 2026 </td>
		<td> 480B </td>
		<td> 35B </td>
		<td> MoE </td>
		<td> 256K (可扩至1M)  </td>
		<td> 信息缺失 </td>
		<td> 信息缺失 </td>
		<td> 信息缺失 </td>
		<td> 信息缺失 </td>
		<td> 性能旗舰：专为代理式工作流设计，仓库级代码理解能力极强，可处理超长上下文 </td>
	</tr>
	<tr>
		<td> Qwen3-Coder-Next </td>
		<td> 2026 </td>
		<td> 80B </td>
		<td> 3B </td>
		<td> MoE </td>
		<td> 256K  </td>
		<td> 70.6% </td>
		<td> 信息缺失 </td>
		<td> 信息缺失 </td>
		<td> 通义千问 </td>
		<td> 效率标杆：激活参数极少，推理速度快，在SWE-Bench上表现惊艳，特别适合需要多轮交互和自主修复的代理场景。 </td>
	</tr>
	<tr>
		<td> Qwen2.5-Coder-32B-Instruct </td>
		<td> 2025 </td>
		<td> 32B </td>
		<td> 32B </td>
		<td> Dense </td>
		<td> 128K </td>
		<td> 信息缺失 </td>
		<td> 信息缺失 </td>
		<td> 73.7% </td>
		<td> Apache-2.0</td>
		<td> 前任拳王：在Qwen3系列发布前是开源SOTA之一，代码修复能力（Aider）极其出色，多语言支持优秀。 </td>
	</tr>
	<tr>
		<td> Qwen2.5-Coder-14B/7B/... </td>
		<td> 2025 </td>
		<td> 14B / 7B /... </td>
		<td> - </td>
		<td> Dense </td>
		<td> 128K </td>
		<td> 信息缺失 </td>
		<td> 信息缺失 </td>
		<td> 信息缺失 </td>
		<td> Apache-2.0 </td>
		<td> 尺寸梯队：提供从0.5B到14B的完整尺寸，适应不同硬件和应用场景。 </td>
	</tr>
	<tr>
		<td rowspan="2"> DeepSeek-Coder </td>
		<td> DeepSeek-Coder-V2 (236B) </td>
		<td> 2025 </td>
		<td> 236B </td>
		<td> 21B </td>
		<td> MoE </td>
		<td> 128K</td>
		<td> 12.7%</td>
		<td> 90.2%</td>
		<td> 信息缺失 </td>
		<td> MIT  </td>
		<td> 性能巨兽：代码生成能力（HumanEval）登顶开源模型，复杂任务表现出色，但真实世界软件工程修复能力（SWE-Bench）相对较弱</td>
	</tr>
	<tr>
		<td> DeepSeek-Coder-V2-Lite (16B) </td>
		<td> 2025 </td>
		<td> 16B </td>
		<td> 2.4B </td>
		<td> MoE </td>
		<td> 128K </td>
		<td> 0.0% </td>
		<td> 81.1% </td>
		<td> 44.4% </td>
		<td> MIT </td>
		<td> 高性价比：236B的“青春版”，在轻量级MoE架构中平衡了性能和效率。 </td>
	</tr>
	<tr>
		<td rowspan="2"> Devstral </td>
		<td> Devstral 2 (123B) </td>
		<td> 2025 </td>
		<td> 123B </td>
		<td> 123B </td>
		<td> Dense </td>
		<td> 256K</td>
		<td> 72.2% </td>
		<td> 信息缺失 </td>
		<td> 信息缺失 </td>
		<td> 商业限制 </td>
		<td> 代理编码新王：SWE-Bench登顶开源模型，专为复杂的多文件编辑和仓库级重构设计 </td>
	</tr>
	<tr>
		<td> Devstral Small 2 (24B) </td>
		<td> 2025 </td>
		<td> 24B </td>
		<td> 24B </td>
		<td> Dense </td>
		<td> 256K</td>
		<td> 68.0% </td>
		<td> 信息缺失 </td>
		<td> 信息缺失 </td>
		<td> Apache-2.0 </td>
		<td> 小钢炮：以极小的参数实现了接近超大模型的SWE-Bench分数，Apache-2.0协议非常友好</td>
	</tr>
	<tr>
		<td> GLM </td>
		<td> GLM-4.7 </td>
		<td> 2025 </td>
		<td> 358B </td>
		<td> 信息缺失 </td>
		<td> MoE </td>
		<td> 信息缺失 </td>
		<td> 信息缺失 </td>
		<td> 84.9% </td>
		<td> 信息缺失 </td>
		<td> MIT </td>
		<td> 全场景智能体：不仅限于编程，在多模态创作、复杂推理和办公场景也有优秀表现，性价比高。 </td>
	</tr>
	<tr>
		<td> MiniMax </td>
		<td> MiniMax M2.1 </td>
		<td> 2025 </td>
		<td> 未公开 </td>
		<td> 未公开 </td>
		<td> 优化架构 </td>
		<td> 信息缺失 </td>
		<td> 信息缺失 </td>
		<td> 88.6% </td>
		<td> 信息缺失 </td>
		<td> 未明确 </td>
		<td> 编程专精：在多语言编程（Rust, Go等）和响应速度上进行了强化，代码通过率高。 </td>
	</tr>
	<tr>
		<td rowspan="4"> 其他 </td>
		<td> StarCoder2 (15B) </td>
		<td> 2024 </td>
		<td> 15B </td>
		<td> 15B </td>
		<td> Dense </td>
		<td> 16K </td>
		<td> 信息缺失 </td>
		<td> 信息缺失 </td>
		<td> 信息缺失 </td>
		<td> 信息缺失 </td>
		<td> 代码填充专家：在代码填充（FIM）任务上表现优异，非常适合IDE自动补全场景。 </td>
	</tr>
	<tr>
		<td> KAT-Dev (32B) </td>
		<td> 2025 </td>
		<td> 32B </td>
		<td> 32B </td>
		<td> Dense </td>
		<td> 32K </td>
		<td> 62.4% </td>
		<td> 信息缺失 </td>
		<td> 信息缺失 </td>
		<td> 信息缺失 </td>
		<td> 软件工程专精：在SWE-Bench上表现不俗，通过创新的强化学习训练，擅长解决实际的GitHub issue。 </td>
	</tr>
	<tr>
		<td> CodeGemma (7B/2B) </td>
		<td> 2024 </td>
		<td> 7B / 2B </td>
		<td> - </td>
		<td> Dense </td>
		<td> 8K </td>
		<td> 信息缺失 </td>
		<td> 信息缺失 </td>
		<td> 信息缺失 </td>
		<td> Gemma Terms </td>
		<td> 轻量级选手：Google出品，身材小巧，专门用于高效的代码补全和生成。 </td>
	</tr>
	<tr>
		<td> DeepSeek-R1 </td>
		<td> 2026 </td>
		<td> 671B </td>
		<td> 37B </td>
		<td> MoE </td>
		<td> 164K </td>
		<td> 信息缺失 </td>
		<td> 信息缺失 </td>
		<td> 信息缺失 </td>
		<td> MIT </td>
		<td> 推理王者：以强大的推理能力著称，在数学、代码等复杂推理任务上对标OpenAI o1，上下文长度优秀。 </td>
	</tr>
</table>