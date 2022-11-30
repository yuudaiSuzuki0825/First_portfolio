<!-- 以下で使用されているメソッドはペジネータインスタンスメソッド。公式で確認。 -->
<!-- 複数ページに分割できるだけのレコード数があるかどうかのチェック。paginate()の引数で指定した値よりも表示させるレコード数が上回っている時。 -->
@if ($paginator->hasPages())
<!-- デベロッパーツールで構造確認してみると色々分かる。なお，class属性値はbootstrap用。 -->
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            <!-- 今いるページが先頭かどうかチェックしている。 -->
            @if ($paginator->onFirstPage())
            <!-- 先頭にいる場合，「‹」をクリックしても遷移しないようにしている。 -->
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <!-- 特殊文字に関してはクイックリファレンスで一覧確認できる。便利。 -->
                    <span class="page-link" aria-hidden="true" id="leftTriangle">&laquo;</span>
                </li>
            @else
            <!-- 先頭以外の場合，「‹」をクリックすると一つ前のページへ遷移するようにしている。 -->
                <li class="page-item">
                    <!-- previousPageUrl()で前ページのURLを取得している。 -->
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&laquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            <!-- $elementsには配列型の値（連想配列でありキーはページ番号，値はURL）か文字列型の値（「...」）のいずれかが格納されている配列（二次元配列）。 -->
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                <!-- $elements（配列）の各要素のうち，文字列型の値が入っているかどうかチェックしている。 -->
                @if (is_string($element))
                <!-- $elementには「…」が入っている。 -->
                    <li class="page-item disabled" aria-disabled="true" id="threeDots"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                <!-- $elements（配列）の各要素のうち，配列型の値が入っているかどうかチェックしている。 -->
                @if (is_array($element))
                <!-- $elementには連想配列（キーはページ番号，値はURL）が入っている。 -->
                    @foreach ($element as $page => $url)
                    <!-- 現在表示しているページの位置とページ番号が一致しているかチェック。 -->
                        @if ($page == $paginator->currentPage())
                            <li class="page-item" aria-current="page" id="match"><span class="page-link">{{ $page }}</span></li>
                        @else
                        <!-- 一致していない場合，遷移できるようにhrefにURLを設定。 -->
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            <!-- 「‹」の逆バージョン。すなわち，今いるページが末尾かどうかチェックしている。 -->
            <!-- 具体的には，まだ表示されていないレコードがあるかどうかのチェックをしている。 -->
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <!-- 次ページのURLを取得。 -->
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true" id="rightTriangle">&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
